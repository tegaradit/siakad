<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class r_jurusan extends Model
{
    use HasFactory;
    protected $table = 'r_jurusans';
    protected $primaryKey = 'id_jur';
    public $incrementing = false; // karena primary key bukan auto-increment
    protected $keyType = 'string'; // primary key bertipe char

    protected $fillable = [
        'nm_jur',
        'nm_intl_jur',
        'u_sma',
        'u_smk',
        'u_pt',
        'u_slb',
        'id_jenj_didik',
        'id_induk_jurusan',
        'id_kel_bidang',
        'a_aktif',
    ];
}
