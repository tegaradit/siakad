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
        'id_prodi',
        'id_university',
        'kode_prodi',
        'nama_prodi',
        'status',
        'id_jenjang_pendidikan',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'id_university', 'id_university');
    }
   public function education_level()
    {
        return $this->belongsTo(Education_level::class, 'id_jenjang_pendidikan', 'id_jenj_didik');
    }
    
}