<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    
    protected $table = 'prodi';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id',
        'code',
        'name',
        'department_id',
        'education_level_id',
        'credit_passed',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Ruangan_jurusan::class, 'department_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(Education_level::class, 'education_level_id');
    }
}
