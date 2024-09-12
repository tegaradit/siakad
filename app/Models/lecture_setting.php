<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_setting extends Model
{
    use HasFactory;
    
    protected $table = 'lecture_settings';
    protected $fillable =[
        'prodi_id',
        'max_number_of_meets',
        'min_number_of_presence',
        'is_prodi'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }    
}
