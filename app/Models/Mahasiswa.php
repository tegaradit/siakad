<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    // Primary key column (default is 'id', but in this case it's 'id_mhs')
    protected $primaryKey = 'id_mhs';

    // Disable auto-incrementing since 'id_mhs' is manually managed
    public $incrementing = false;

    // If the primary key is not an integer, set this to false
    protected $keyType = 'int';

    // Define the columns that are mass assignable
    protected $fillable = [
        'id_pd', 'nm_pd', 'jk', 'jln', 'rt', 'rw', 'nm_dsn', 'ds_kel', 'kode_pos', 'nisn', 'nik',
        'tmpt_lahir', 'tgl_lahir', 'nm_ayah', 'tgl_lahir_ayah', 'nik_ayah', 'id_jenjang_pendidikan_ayah', 'id_pekerjaan_ayah',
        'id_penghasilan_ayah', 'id_kebutuhan_khusus_ayah', 'nm_ibu_kandung', 'tgl_lahir_ibu', 'nik_ibu', 'id_jenjang_pendidikan_ibu',
        'id_pekerjaan_ibu', 'id_penghasilan_ibu', 'id_kebutuhan_khusus_ibu', 'nm_wali', 'tgl_lahir_wali', 'id_jenjang_pendidikan_wali',
        'id_pekerjaan_wali', 'id_penghasilan_wali', 'id_kk', 'no_tel_rmh', 'no_hp', 'email', 'a_terima_kps', 'no_kps', 'npwp', 'id_wil',
        'id_jns_tinggal', 'id_agama', 'id_alat_transport', 'kewarganegaraan', 'no_daftar_lama', 'foto', 'id_kabupaten', 'id_kecamatan',
        'id_goldarah', 'asal_sma', 'jenjangsekolah', 'jurusan_sekolah_asal', 'nomor_sttb', 'rata_nilai_sttb', 'status_data'
    ];

    // Define the columns that should be treated as dates
    protected $dates = [
        'tgl_lahir', 'tgl_lahir_ayah', 'tgl_lahir_ibu', 'tgl_lahir_wali'
    ];

    // Disable timestamps (created_at, updated_at) if not needed
    public $timestamps = false;
}
