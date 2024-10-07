<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Mahasiswa;
use App\Models\MahasiswaPt;
use DB;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    public function index(Request $request)
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

    public function create()
    {
        $dataProdi = All_prodi::rightjoin('identitas_pt', 'all_prodi.id_sp', '=', 'identitas_pt.current_id_sp')
            ->leftjoin('education_level', 'all_prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
            ->get([
                'all_prodi.id_prodi',
                'nama_prodi',
                'nm_jenj_didik AS jenjang_pendidikan'
            ]);

        return view('pages.admin.mahasiswa.add')->with(compact('dataProdi'));
    }

    public function searchMahasiswa(Request $request)
    {
        $searchName = $request->json()->get('name');
        //--> SEARCH WITH WHERE EQUAL's VERSION
        return DB::table('mahasiswa')->where(DB::raw('UPPER(nm_pd)'), '=', $searchName)->get();
        //--> SEARCH WITH WHERE LIKE's VERSION
        // return DB::table('mahasiswa')->where('nm_pd', 'like', "%$searchName%")->get();
    }

    public function store(Request $request)
    {
        $existing_id_mahasiswa = $request->existing_id_mahasiswa;
        // return $existing_id_mahasiswa;

        if (!$existing_id_mahasiswa) {
            // Validation rules for mahasiswa fields
            $request->validate([
                'nm_pd' => 'required|string|max:100', // nama mahasiswa
                'jk' => 'nullable|in:L,P', // jenis kelamin
                'jln' => 'nullable|string|max:80', // jalan/alamat
                'rt' => 'nullable|numeric|max:99',
                'rw' => 'nullable|numeric|max:99',
                'kode_pos' => 'nullable|string|max:5',
                'nik' => 'nullable|string|max:16',
                'tmpt_lahir' => 'nullable|string|max:255',
                'tgl_lahir' => 'nullable|date',
                'nm_ayah' => 'nullable|string|max:100',
                'nm_dsn' => 'nullable|string|max:60',
                'ds_kel' => 'nullable|string|max:60',
                'id_goldarah' => 'required|numeric',
                'id_agama' => 'required|numeric',
                'a_terima_kps' => 'nullable',
                'id_kecamatan' => 'required|string|max:100',
                'nm_ibu_kandung' => 'nullable|string|max:100',
                'nisn' => 'nullable|string|max:10',
                'nik_ayah' => 'nullable|string|max:10',
                'nik_ibu' => 'nullable|string|max:10',
                'id_pekerjaan_ayah' => 'nullable|numeric',
                'id_pekerjaan_ibu' => 'nullable|numeric',
                'no_hp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:60',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file size (max 2MB)
                'jenjangsekolah' => 'required|string|max:30', // jenjang sekolah
                'asal_sma' => 'nullable|string|max:50',
                'jurusan_sekolah_asal' => 'required|string|max:30',
                'nomor_sttb' => 'nullable|string|max:50',
                'rata_nilai_sttb' => 'nullable|numeric|max:100'
            ]);

            // data mahasiswa
            $mahasiswa = new Mahasiswa();
            $mahasiswa->id_pd = (string) Str::uuid(); // generate UUID
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
            $mahasiswa->id_kecamatan = $request->id_kecamatan;
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

            // upload foto
            if ($request->hasFile('foto')) {
                $filePath = $request->file('foto')->store('foto_mahasiswa', 'public');
                $mahasiswa->foto = $filePath;
            }
            $mahasiswa->save();
        }

        // Validation rules for mahasiswa_pt fields
        $request->validate([
            'nipd' => 'nullable|string|max:24', // NPM
            'id_jns_daftar' => 'nullable|numeric',
            'id_jenis_mhs' => 'required|numeric',
            'id_pt_asal' => 'nullable|string:max:40',
            'id_prodi_asal' => 'nullable|string:max:40',
            'sks_diakui' => 'nullable|numeric',
            'no_seri_ijazah' => 'nullable|string|max:80',
            'mulai_smt' => 'nullable|string|max:5',
            'mulai_pada_smt' => 'required|numeric',
            'no_peserta_ujian' => 'nullable|string|max:20',
            'id_prodi' => 'required|uuid' // ID Prodi
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

        return redirect()->back()->with('success', 'Data mahasiswa berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $dataProdi = All_prodi::rightjoin('identitas_pt', 'all_prodi.id_sp', '=', 'identitas_pt.current_id_sp')
            ->leftjoin('education_level', 'all_prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
            ->get([
                'all_prodi.id_prodi',
                'nama_prodi',
                'nm_jenj_didik AS jenjang_pendidikan'
            ]);
        $mahasiswa_pt = MahasiswaPt::findOrFail($id);
        $mahasiswa = Mahasiswa::where('id_pd', $mahasiswa_pt->id_pd)->firstOrFail();
        return view('pages.admin.mahasiswa.edit', compact('mahasiswa', 'mahasiswa_pt', 'dataProdi'));
    }

    public function update (Request $request, string $id) {
        $mahasiswa_pt = MahasiswaPt::findOrFail($id);
        $mahasiswa = Mahasiswa::where('id_pd', $mahasiswa_pt->id_pd)->firstOrFail();

        // Validation rules for mahasiswa fields
        $request->validate([
            'nm_pd' => 'required|string|max:100',
            'jk' => 'nullable|in:L,P',
            'jln' => 'nullable|string|max:80',
            'rt' => 'nullable|numeric|max:99',
            'rw' => 'nullable|numeric|max:99',
            'kode_pos' => 'nullable|string|max:5',
            'nik' => 'nullable|string|max:16',
            'tmpt_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'nm_ayah' => 'nullable|string|max:100',
            'nm_dsn' => 'nullable|string|max:60',
            'ds_kel' => 'nullable|string|max:60',
            'id_goldarah' => 'required|numeric',
            'id_agama' => 'required|numeric',
            'a_terima_kps' => 'nullable',
            'id_kecamatan' => 'required|string|max:100',
            'nm_ibu_kandung' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:10',
            'nik_ayah' => 'nullable|string|max:10',
            'nik_ibu' => 'nullable|string|max:10',
            'id_pekerjaan_ayah' => 'nullable|numeric',
            'id_pekerjaan_ibu' => 'nullable|numeric',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:60',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenjangsekolah' => 'required|string|max:30',
            'asal_sma' => 'nullable|string|max:50',
            'jurusan_sekolah_asal' => 'required|string|max:30',
            'nomor_sttb' => 'nullable|string|max:50',
            'rata_nilai_sttb' => 'nullable|numeric|max:100'
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
        $mahasiswa->id_kecamatan = $request->id_kecamatan;
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

        // Update foto if uploaded
        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($mahasiswa->foto && \Storage::disk('public')->exists($mahasiswa->foto)) {
                \Storage::disk('public')->delete($mahasiswa->foto);
            }
            // Store the new photo
            $filePath = $request->file('foto')->store('foto_mahasiswa', 'public');
            $mahasiswa->foto = $filePath;
        }
        $mahasiswa->save();

        // Validation rules for mahasiswa_pt fields
        $request->validate([
            'nipd' => 'nullable|string|max:24',
            'id_jns_daftar' => 'nullable|numeric',
            'id_jenis_mhs' => 'required|numeric',
            'id_pt_asal' => 'nullable|string:max:40',
            'id_prodi_asal' => 'nullable|string:max:40',
            'sks_diakui' => 'nullable|numeric',
            'no_seri_ijazah' => 'nullable|string|max:80',
            'mulai_smt' => 'nullable|string|max:5',
            'mulai_pada_smt' => 'required|numeric',
            'no_peserta_ujian' => 'nullable|string|max:20',
            'id_prodi' => 'required|uuid'
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

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(string $id)
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
}
