<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_pt extends Model
{
    use HasFactory;
    protected $table = 't_pt';
    protected $primaryKey = 'id_pt';
    public $incrementing = false; // karena primary key bukan auto-increment
    protected $keyType = 'string'; // primary key bertipe string

    protected $fillable = [
        'kode_pt',
        'nama_pt',
        'nama_singkat',
    ];

    // Jika Anda tidak ingin menggunakan timestamps (created_at dan updated_at)
    // public $timestamps = false;
}
