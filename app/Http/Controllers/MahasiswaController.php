<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Educational_unit;
use App\Models\Mahasiswa;
use App\Models\MahasiswaPt;
use App\Models\student_type;
use App\Models\User;
use App\Models\Wilayah;
use DB;
use Hash;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    public function index (Request $request)
    {
        if ($request->ajax()) {
            $dataMahasiswa = DB::table('mahasiswa')
                ->leftJoin('mahasiswa_pt', 'mahasiswa.id_pd', '=', 'mahasiswa_pt.id_pd')
                ->leftJoin('all_prodi', 'mahasiswa_pt.id_prodi', '=', 'all_prodi.id_prodi')
                ->get([
                    'mahasiswa_pt.id_reg_pd AS id',
                    'nipd AS NPM',
                    'nm_pd AS Nama',
                    'mulai_smt AS Angkatan',
                    'jk AS JenisKelamin',
                    'tmpt_lahir AS TempatLahir',
                    'tgl_lahir AS TanggalLahir',
                    'nama_prodi AS ProgramStudi',
                    'id_jenis_mhs AS Jenis',
                    'mahasiswa_pt.status_data AS StatusData',
                    // 'SINK'
                ]);

            return DataTables::of($dataMahasiswa)
                ->addColumn('action', function ($row) {
                    $editUrl = route('mahasiswa.edit', $row->id ?? '');
                    $deleteUrl = route('mahasiswa.destroy', $row->id ?? '');
                    $csrfToken = csrf_field();
                    $methodField = method_field('delete');

                    return <<<EOT
                        <form id="delete-form-$row->id" onsubmit="event.preventDefault(); confirmDelete('$row->id');" action="$deleteUrl" method="POST">
                            $csrfToken
                            $methodField
                            <a href="$editUrl" class="btn btn-warning btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <button type="submit" class="btn icon icon-left btn-danger btn-sm delete" title="Delete">
                                <i class="fas fa-trash-alt"></i> 
                                Hapus
                            </button>
                        </form>
                    EOT;
                })
                ->editColumn('Jenis', function ($row) {
                    $jenisMahasiswa = [
                        "Lainnya",
                        "Reguler",
                        "Karyawan",
                        "P2K",
                        "PJJ"
                    ];
                    return $jenisMahasiswa[intval($row->Jenis)];
                })
                ->editColumn('JenisKelamin', function ($row) {
                    return $row->JenisKelamin == 'L' ? 'Laki - Laki' : 'Perempuan';
                })
                ->make();
        }

        return view('pages.admin.mahasiswa.index');
    }

    public function create ()
    {
        $dataJenisMahasiswa = student_type::all();
        $dataProdi = All_prodi::rightjoin('identitas_pt', 'all_prodi.id_sp', '=', 'identitas_pt.current_id_sp')
            ->leftjoin('education_level', 'all_prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
            ->where('all_prodi.status', '=', 'A')
            ->get([
                'all_prodi.status',
                'all_prodi.id_prodi',
                'all_prodi.nama_prodi',
                'nm_jenj_didik AS jenjang_pendidikan'
            ]);

        return view('pages.admin.mahasiswa.add')->with(compact('dataProdi', 'dataJenisMahasiswa'));
    }

    public function searchMahasiswa (Request $request)
    {
        $searchName = $request->json()->get('name');
        //--> SEARCH WITH WHERE EQUAL's VERSION
        return DB::table('mahasiswa')->where(DB::raw('UPPER(nm_pd)'), '=', $searchName)->get();
        //--> SEARCH WITH WHERE LIKE's VERSION
        // return DB::table('mahasiswa')->where('nm_pd', 'like', "%$searchName%")->get();
    }
    
    public function store (Request $request)
    {
        $existing_id_mahasiswa = $request->existing_id_mahasiswa;
        // return $existing_id_mahasiswa;
        
        // Validation rules for mahasiswa fields
        $mahasiswa = $existing_id_mahasiswa ? Mahasiswa::findOrFail($existing_id_mahasiswa) : new Mahasiswa();
        $validateRules = [
            'nm_pd'       => 'required|string|max:100', // nama mahasiswa //--> is also field for users table [name]
            'jk'          => 'required|in:L,P', // jenis kelamin
            'jln'         => 'required|string|max:80', // jalan/alamat
            'rt'          => 'required|numeric|max:99',
            'rw'          => 'required|numeric|max:99',
            'kode_pos'    => 'required|string|max:5',
            'nik'         => 'required|string|max:16|min:16',
            'tmpt_lahir'  => 'required|string|max:255',
            'tgl_lahir'   => 'required|date',
            'nm_ayah'     => 'required|string|max:100',
            'nm_dsn'      => 'required|string|max:60',
            'ds_kel'      => 'required|string|max:60',
            'id_goldarah' => 'required|numeric',
            'id_agama'    => 'required|numeric',
            'a_terima_kps'         => 'nullable',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file size (max 2MB) //--> is also field for users table [photo]
            'id_wil'               => 'required|string|max:100', //-->
            'nm_ibu_kandung'       => 'required|string|max:100',
            'nisn'                 => 'required|string|max:10',
            'nik_ayah'             => 'required|string|max:16|min:16',
            'nik_ibu'              => 'required|string|max:16|min:16',
            'id_pekerjaan_ayah'    => 'required|numeric',
            'id_pekerjaan_ibu'     => 'required|numeric',
            'no_hp'                => 'required|string|max:20', //--> is also field for users table [phone_number]
            'jenjangsekolah'       => 'required|string|max:30', // jenjang sekolah
            'asal_sma'             => 'required|string|max:50',
            'jurusan_sekolah_asal' => 'required|string|max:30',
            'nomor_sttb'           => 'required|string|max:50',
            'rata_nilai_sttb'      => 'required|numeric|max:100'
        ];
        $validateRules['email'] = $existing_id_mahasiswa ? "required|email|max:60|unique:mahasiswa,email,$mahasiswa->id_pd,id_pd" : 'required|email|max:60|unique:mahasiswa,email';
        $request->validate($validateRules);

        // data mahasiswa
        if (!$existing_id_mahasiswa) $mahasiswa->id_pd = (string) Str::uuid(); // generate UUID
        
        $mahasiswa->nm_pd = $request->nm_pd;
        $mahasiswa->jk = $request->jk;
        $mahasiswa->jln = $request->jln;
        $mahasiswa->rt = $request->rt;
        $mahasiswa->rw = $request->rw;
        $mahasiswa->kode_pos = $request->kode_pos;
        $mahasiswa->nik = $request->nik;
        $mahasiswa->tmpt_lahir = $request->tmpt_lahir;
        $mahasiswa->tgl_lahir = $request->tgl_lahir;
        $mahasiswa->nm_ayah = $request->nm_ayah;
        $mahasiswa->nm_dsn = $request->nm_dsn;
        $mahasiswa->ds_kel = $request->ds_kel;
        $mahasiswa->id_goldarah = $request->id_goldarah;
        $mahasiswa->id_agama = $request->id_agama;
        $mahasiswa->a_terima_kps = $request->a_terima_kps ?? 0;
        $mahasiswa->nm_ibu_kandung = $request->nm_ibu_kandung;
        $mahasiswa->nisn = $request->nisn;
        $mahasiswa->nik_ayah = $request->nik_ayah;
        $mahasiswa->nik_ibu = $request->nik_ibu;
        $mahasiswa->id_pekerjaan_ayah = $request->id_pekerjaan_ayah;
        $mahasiswa->id_pekerjaan_ibu = $request->id_pekerjaan_ibu;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->email = $request->email;
        $mahasiswa->jenjangsekolah = $request->jenjangsekolah;
        $mahasiswa->asal_sma = $request->asal_sma;
        $mahasiswa->jurusan_sekolah_asal = $request->jurusan_sekolah_asal;
        $mahasiswa->nomor_sttb = $request->nomor_sttb;
        $mahasiswa->rata_nilai_sttb = $request->rata_nilai_sttb;
        
        // data wilayah
        [$id_kecamatan, $id_kabupaten, $id_provinsi] = explode('-', $request->id_wil);
        $mahasiswa->id_kecamatan = $id_kecamatan;
        $mahasiswa->id_kabupaten = $id_kabupaten;
        $mahasiswa->id_wil = $id_provinsi;
        
        // data user
        $userData = [
            'name' => $request->nm_pd,
            'phone_number' => $request->no_hp,
            'role_id' => 9, //--> id role's for "mahasiswa"
            'password' => Hash::make($request->no_hp),
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('foto_mahasiswa', 'public');
            $mahasiswa->foto = $filePath;
            $userData['photo'] = $filePath;
        }

        //? update data user if email is exist or add new when email is not exist
        if ($request->filled('email')) {
            User::updateOrCreate(
                ['email' => $request->input('email')],
                $userData
            );
        }
        $mahasiswa->save();

        // Validation rules for mahasiswa_pt fields
        // return $request->all();
        $request->validate([
            'nipd'           => 'required|string|max:24', // NPM
            'id_jns_daftar'  => 'required|numeric',
            'id_jenis_mhs'   => 'required|exists:student_types,id',
            'id_pt_asal'     => 'nullable|string:max:40',
            'id_prodi_asal'  => 'nullable|string:max:40',
            'sks_diakui'     => 'nullable|numeric',
            'no_seri_ijazah' => 'nullable|string|max:80',
            'mulai_smt'      => 'required|string|max:5',
            'mulai_pada_smt' => 'required|numeric',
            'id_prodi'       => 'required|uuid' // ID Prodi
        ]);

        // data mahasiswa_pt
        $mahasiswa_pt = new MahasiswaPt();
        $mahasiswa_pt->id_reg_pd = (string) Str::uuid(); // generate UUID
        $mahasiswa_pt->id_pd = $existing_id_mahasiswa ?? $mahasiswa->id_pd; // foreign key to tabel mahasiswa
        $mahasiswa_pt->nipd = $request->nipd;
        $mahasiswa_pt->id_jns_daftar = $request->id_jns_daftar;
        $mahasiswa_pt->id_jenis_mhs = $request->id_jenis_mhs;
        $mahasiswa_pt->id_pt_asal = $request->id_pt_asal;
        $mahasiswa_pt->id_prodi_asal = $request->id_prodi_asal;
        $mahasiswa_pt->sks_diakui = $request->sks_diakui;
        $mahasiswa_pt->no_seri_ijazah = $request->no_seri_ijazah;
        $mahasiswa_pt->mulai_smt = $request->mulai_smt;
        $mahasiswa_pt->mulai_pada_smt = $request->mulai_pada_smt;
        $mahasiswa_pt->no_peserta_ujian = $request->no_peserta_ujian;
        $mahasiswa_pt->id_prodi = $request->id_prodi;
        $mahasiswa_pt->save();

        return redirect()->route('mahasiswa.index')->with('success', "Data mahasiswa berhasil disimpan, dan user sudah di buat \n dengan username = $request->nm_pd dan password $request->no_hp");
    }

    public function edit (string $id)
    {
        $dataJenisMahasiswa = student_type::all();
        $dataProdi = All_prodi::rightjoin('identitas_pt', 'all_prodi.id_sp', '=', 'identitas_pt.current_id_sp')
            ->leftjoin('education_level', 'all_prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
            ->where('all_prodi.status', '=', 'A')
            ->get([
                'all_prodi.id_prodi',
                'nama_prodi',
                'nm_jenj_didik AS jenjang_pendidikan'
            ]);
        $mahasiswa_pt = MahasiswaPt::findOrFail($id);
        $mahasiswa = Mahasiswa::where('id_pd', $mahasiswa_pt->id_pd)->firstOrFail();
        $wilayah = Wilayah::where(function ($query) use ($mahasiswa) {
            $query->orWhere('id_wil', '=', $mahasiswa->id_kecamatan)
            ->orWhere('id_wil', '=', $mahasiswa->id_kabupaten)
            ->orWhere('id_wil', '=', $mahasiswa->id_wil);
        })->orderBy('id_wil')->get(['id_wil', 'nm_wil'])->toArray();
        
        $currentSelectedWilayah = ['id' => '', 'name' => ''];
        if (count($wilayah) == 3) {
            $currentSelectedWilayah = [
                //--> [kecamatan] [kabupaten] [provinsi]
                'id' => "$mahasiswa->id_kecamatan-$mahasiswa->id_kabupaten-$mahasiswa->id_wil",
                'name' => (trim($wilayah[2]['nm_wil']) ?? '') . ' - ' . (trim($wilayah[1]['nm_wil']) ?? '') . ' - ' . (trim($wilayah[0]['nm_wil']) ?? '')
            ];
        }
        $isRegistered = User::where('email', '=', $mahasiswa->email)->count() > 0;

        $prodi_asal = $this->searchProdiByUnivName(new Request(['universityName' => $mahasiswa_pt->id_pt_asal]));

        return view('pages.admin.mahasiswa.edit', compact('prodi_asal', 'mahasiswa', 'mahasiswa_pt', 'dataProdi', 'isRegistered', 'dataJenisMahasiswa', 'currentSelectedWilayah'));
    }

    public function update (Request $request, string $id) {
        $mahasiswa_pt = MahasiswaPt::findOrFail($id);
        $mahasiswa = Mahasiswa::findOrFail($mahasiswa_pt->id_pd);

        // Validation rules for mahasiswa fields
        $request->validate([
            'nm_pd' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'jln' => 'required|string|max:80',
            'rt' => 'required|numeric|max:99',
            'rw' => 'required|numeric|max:99',
            'kode_pos' => 'required|string|max:5',
            'nik' => 'required|string|max:16|min:16',
            'tmpt_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'nm_ayah' => 'required|string|max:100',
            'nm_dsn' => 'required|string|max:60',
            'ds_kel' => 'required|string|max:60',
            'id_goldarah' => 'required|numeric',
            'id_agama' => 'required|numeric',
            'a_terima_kps' => 'nullable',
            'id_wil' => 'required|string|max:100', //-->
            'nm_ibu_kandung' => 'required|string|max:100',
            'nisn' => 'required|string|max:10',
            'nik_ayah' => 'required|string|max:16|min:16',
            'nik_ibu' => 'required|string|max:16|min:16',
            'id_pekerjaan_ayah' => 'required|numeric',
            'id_pekerjaan_ibu' => 'required|numeric',
            'no_hp' => 'required|string|max:20',
            'email' => "required|email|max:60|unique:mahasiswa,email,$mahasiswa->id_pd,id_pd",
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenjangsekolah' => 'required|string|max:30',
            'asal_sma' => 'required|string|max:50',
            'jurusan_sekolah_asal' => 'required|string|max:30',
            'nomor_sttb' => 'required|string|max:50',
            'rata_nilai_sttb' => 'required|numeric|max:100'
        ]);

        // Update mahasiswa data
        $mahasiswa->nm_pd = $request->nm_pd;
        $mahasiswa->jk = $request->jk;
        $mahasiswa->jln = $request->jln;
        $mahasiswa->rt = $request->rt;
        $mahasiswa->rw = $request->rw;
        $mahasiswa->kode_pos = $request->kode_pos;
        $mahasiswa->nik = $request->nik;
        $mahasiswa->tmpt_lahir = $request->tmpt_lahir;
        $mahasiswa->tgl_lahir = $request->tgl_lahir;
        $mahasiswa->nm_ayah = $request->nm_ayah;
        $mahasiswa->nm_dsn = $request->nm_dsn;
        $mahasiswa->ds_kel = $request->ds_kel;
        $mahasiswa->id_goldarah = $request->id_goldarah;
        $mahasiswa->id_agama = $request->id_agama;
        $mahasiswa->a_terima_kps = $request->a_terima_kps ?? 0;
        $mahasiswa->nm_ibu_kandung = $request->nm_ibu_kandung;
        $mahasiswa->nisn = $request->nisn;
        $mahasiswa->nik_ayah = $request->nik_ayah;
        $mahasiswa->nik_ibu = $request->nik_ibu;
        $mahasiswa->id_pekerjaan_ayah = $request->id_pekerjaan_ayah;
        $mahasiswa->id_pekerjaan_ibu = $request->id_pekerjaan_ibu;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->email = $request->email;
        $mahasiswa->jenjangsekolah = $request->jenjangsekolah;
        $mahasiswa->asal_sma = $request->asal_sma;
        $mahasiswa->jurusan_sekolah_asal = $request->jurusan_sekolah_asal;
        $mahasiswa->nomor_sttb = $request->nomor_sttb;
        $mahasiswa->rata_nilai_sttb = $request->rata_nilai_sttb;

        // data wilayah
        [$id_kecamatan, $id_kabupaten, $id_provinsi] = explode('-', $request->id_wil);
        $mahasiswa->id_kecamatan = $id_kecamatan;
        $mahasiswa->id_kabupaten = $id_kabupaten;
        $mahasiswa->id_wil = $id_provinsi;

        // user field
        $userData = [
            'name' => $request->nm_pd,
            'phone_number' => $request->no_hp,
            'role_id' => 9, //--> id role's for "mahasiswa"
            'password' => Hash::make($request->no_hp),
        ];


        // Update foto if uploaded
        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($mahasiswa->foto && \Storage::disk('public')->exists($mahasiswa->foto)) {
                \Storage::disk('public')->delete($mahasiswa->foto);
            }
            // Store the new photo
            $filePath = $request->file('foto')->store('foto_mahasiswa', 'public');
            $mahasiswa->foto = $filePath;
            $userData['photo'] = $filePath;
        }
        $mahasiswa->save();
    
        //? update data user if email is exist or add new when email is not exist
        if ($request->filled('email')) {
            User::updateOrCreate(
                ['email' => $request->input('email')],
                $userData
            );
        }

        // Validation rules for mahasiswa_pt fields
        $request->validate([
            'nipd' => 'required|string|max:24', // NPM
            'id_jns_daftar' => 'required|numeric',
            'id_jenis_mhs' => 'required|exists:student_types,id',
            'id_pt_asal' => 'nullable|string:max:40',
            'id_prodi_asal' => 'nullable|string:max:40',
            'sks_diakui' => 'nullable|numeric',
            'no_seri_ijazah' => 'nullable|string|max:80',
            'mulai_smt' => 'required|string|max:5',
            'mulai_pada_smt' => 'required|numeric',
            'id_prodi' => 'required|uuid' // ID Prodi
        ]);

        // Update mahasiswa_pt data
        $mahasiswa_pt->nipd = $request->nipd;
        $mahasiswa_pt->id_jns_daftar = $request->id_jns_daftar;
        $mahasiswa_pt->id_jenis_mhs = $request->id_jenis_mhs;
        $mahasiswa_pt->id_pt_asal = $request->id_pt_asal;
        $mahasiswa_pt->id_prodi_asal = $request->id_prodi_asal;
        $mahasiswa_pt->sks_diakui = $request->sks_diakui;
        $mahasiswa_pt->no_seri_ijazah = $request->no_seri_ijazah;
        $mahasiswa_pt->mulai_smt = $request->mulai_smt;
        $mahasiswa_pt->mulai_pada_smt = $request->mulai_pada_smt;
        $mahasiswa_pt->no_peserta_ujian = $request->no_peserta_ujian;
        $mahasiswa_pt->id_prodi = $request->id_prodi;
        $mahasiswa_pt->save();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy (string $id)
    {
        $mahasiswa_pt = MahasiswaPt::findOrFail($id);
        $id_pd = $mahasiswa_pt->id_pd;

        // Delete the mahasiswa_pt record
        $mahasiswa_pt->delete();

        // Check if there are any remaining records in mahasiswa_pt with the same id_pd
        $remainingRecords = MahasiswaPt::where('id_pd', $id_pd)->count();

        // If no remaining records, delete the mahasiswa record
        if ($remainingRecords === 0) {
            $mahasiswa = Mahasiswa::where('id_pd', $id_pd)->firstOrFail();
            $mahasiswa->delete();
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function searchWilayah (Request $request) {
        /** //? LEVEL
         * --> provinsi [1]
         * --> kebupaten [2]
         * --> kecamatan [3]
         * 
         * display with composition [3, 2, 1]
         */
        $name = $request->nama_wilayah;

        $results = Wilayah::select(
            'kec.id_wil AS id_kecamatan',
            'kab.id_wil AS id_kabupaten',
            'prop.id_wil AS id_provinsi',
            DB::raw("CONCAT(TRIM(kec.nm_wil), ' - ', TRIM(kab.nm_wil), ' - ', TRIM(prop.nm_wil)) AS data")
        )
        ->from('wilayah AS kec')
        ->leftJoin('wilayah AS kab', 'kec.id_induk_wilayah', '=', 'kab.id_wil')
        ->leftJoin('wilayah AS prop', 'kab.id_induk_wilayah', '=', 'prop.id_wil')
        ->where('kec.id_level_wil', 3)
        ->where(function ($query) use ($name) {
            $query->where('kec.nm_wil', 'LIKE', "%$name%")
                ->orWhere('kab.nm_wil', 'LIKE', "%$name%")
                ->orWhere('prop.nm_wil', 'LIKE', "%$name%");
        })
        ->get();

        return response()->json($results);
    }

    public function resetPassword (string $id_mahasiswa) {
        // return 'hitted';
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
        // return $mahasiswa;
        
        $user = User::where('email', '=', $mahasiswa->email)->firstOrFail();
        // return $user;
        $user->password = Hash::make($mahasiswa->no_hp);
        $user->save();

        return redirect()->back()->with('success', "Password Di Set Ke Nomor Telepon, password = $mahasiswa->no_hp");
    }

    public function searchUniversity (Request $request) {
        return Educational_unit::where('nm_lemb', 'LIKE', "%$$request->universityName%")
            ->get(['id_sp', 'nm_lemb']);
    }

    public function searchProdiByUnivName (Request $request) {
        $university = Educational_unit::where(DB::raw('UPPER(nm_lemb)'), '=', strtoupper($request->universityName))->first(['id_sp']);
        if ($university == null) 
            return ['empty' => true];
        return All_prodi::where('id_sp', '=', $university->id_sp)->get(['id_prodi', 'nama_prodi']);
    }
}
