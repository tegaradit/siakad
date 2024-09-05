<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_prodi extends Model
{
    use HasFactory;
    protected $table = 'all_prodis';
    protected $primaryKey = 'id_prodi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_prodi',
        'id_pt',
        'kode_prodi',
        'nama_prodi',
        'status',
        'id_jenjang_pendidikan',
    ];
    
}