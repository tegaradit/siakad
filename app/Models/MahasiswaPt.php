<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaPt extends Model
{
    protected $table = 'mahasiswa_pt';
    protected $primaryKey = 'id_mpt';

    protected $fillable = [
        'id_reg_pd',
        'id_mhs',
        'id_pd',
        'id_sp',
        'id_prodi',
        'nipd',
        'nipd_lama',
        'tgl_masuk_sp',
        'tgl_keluar',
        'ket',
        'skhun',
        'no_peserta_ujian',
        'no_seri_ijazah',
        'a_pernah_paud',
        'a_pernah_tk',
        'tgl_create',
        'mulai_smt',
        'sks_diakui',
        'jalur_skripsi',
        'judul_skripsi',
        'bln_awal_bimbingan',
        'bln_akhir_bimbingan',
        'sk_yudisium',
        'tgl_sk_yudisium',
        'ipk',
        'sert_prof',
        'a_pindah_mhs_asing',
        'id_pt_asal',
        'id_prodi_asal',
        'id_jns_daftar',
        'id_jns_keluar',
        'id_jalur_masuk',
        'id_pembiayaan',
        'id_jenis_mhs',
        'biaya_masuk',
        'status_data',
        'no_daftar',
        'nmpd',
        'semester',
        'id_jenj_didik_biaya',
        'gen_tag_before',
        'mulai_pada_smt',
        'id_model_bayar',
    ];

    public $timestamps = true;
}
