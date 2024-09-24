<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class All_prodi extends Model
{
    use HasFactory;
    protected $table = 'all_prodi';
    protected $primaryKey = 'id_prodi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "nama_prodi",
        "smt_mulai",
        "kode_prodi",
        "nm_prodi_english",
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
        "status",
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

    public function educational_unit(): BelongsTo
    {
        return $this->belongsTo(Educational_unit::class, 'id_sp', 'id_sp');
    }
    public function education_level()
    {
        return $this->belongsTo(Education_level::class, 'id_jenj_didik', 'id_jenj_didik');
    }
    
}