<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        "nama_prodi",
        "smt_mulai",
        "kode_prodi",
        "nm_prodi_english",
        "jln",
        "rt",
        "rw",
        "nm_dsn",
        "ds_kel",
        "kode_pos",
        "lintang",
        "bujur",
        "no_tel",
        "no_fax",
        "email",
        "website",
        "singkatan",
        "tgl_berdiri",
        "sk_selenggara",
        "tgl_sk_selenggara",
        "tmt_sk_selenggara",
        "tst_sk_selenggara",
        "kpst_pd",
        "sks_lulus",
        "gelar_lulusan",
        "stat_prodi",
        "polesei_nilai",
        "a_kependidikan",
        "sistem_ajar",
        "luas_lab",
        "kapasitas_prak_satu_shift",
        "jml_mhs_pengguna",
        "jml_jam_penggunaan",
        "jml_prodi_pengguna",
        "jml_modul_prak_sendiri",
        "jml_modul_prak_lain",
        "fungsi_selain_prak",
        "penggunaan_lab",
        "id_sp",
        "id_jenj_didik",
        "id_jns_sms",
        "id_fungsi_lab",
        "id_kel_usaha",
        "id_blob",
        "id_wil",
        "id_jur",
        "id_fakultas",
        "id_induk_sms",
        "kode",
        "max_sks1"
    ];

    public function department()
    {
        return $this->belongsTo(Ruangan_jurusan::class, 'department_id', 'id_jur');
    }

    public function educationLevel()
    {
        return $this->belongsTo(Education_level::class, 'education_level_id', 'id_jenj_didik');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
