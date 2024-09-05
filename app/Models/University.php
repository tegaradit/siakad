<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $table = 'university';
    protected $primaryKey = 'id_university';
    public $incrementing = false; // karena primary key bukan auto-increment
    protected $keyType = 'string'; // primary key bertipe string

    protected $fillable = [
        'kode_pt',
        'nama_pt',
        'nama_singkat',
    ];

}
