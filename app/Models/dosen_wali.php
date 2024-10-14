<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class dosen_wali extends Model 
{
    use HasFactory;

    protected $table = 'dosen_wali';
    protected $primaryKey = 'id';
    
    public $incrementing = true; 

    protected $fillable = [
        'lecture_id',
        'id_pd',
    ];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class, 'lecture_id', 'id');
    }
    
     public function mahasiswaPt()
    {
        return $this->belongsTo(MahasiswaPt::class, 'id_pd', 'id_pd'); // Menggunakan id_pd sebagai foreign key
    }
    
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_pd', 'id_pd'); 
    }
}