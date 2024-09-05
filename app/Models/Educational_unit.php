<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational_unit extends Model
{
    use HasFactory;
    protected $table = 'educational_unit';
    protected $primaryKey = 'id_sp';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_sp',
        'nm_lemb',
        'nss',
        'npsn',
        'nm_singkat',
        'jln',
        'rt',
        'rw',
        'nm_dsn',
        'ds_kel',
        'kode_pos',
        'lintang',
        'bujur',
        'no_tel',
        'no_fax',
        'email',
        'website',
        'stat_sp',
        'sk_pendirian_sp',
        'tgl_sk_pendirian_sp',
        'tgl_berdiri',
        'sk_izin_operasi',
        'tgl_sk_izin_operasi',
        'no_rek',
        'nm_bank',
        'unit_cabang',
        'nm_rek',
        'a_mbs',
        'luas_tanah_milik',
        'luas_tanah_bukan_milik',
        'a_lptk',
        'kode_reg',
        'npwp',
        'nm_wp',
        'flag',
        'id_pembina',
        'id_blob',
        'id_stat_milik',
        'id_wil',
        'id_kk',
        'id_bp',
    ];
}