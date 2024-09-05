<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_prodi extends Model
{
    
    protected $table = 't_prodi';
    
    // Use UUID instead of auto-incrementing ID
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

    // Define relationships
    public function department()
    {
        return $this->belongsTo(r_jurusan::class, 'department_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(education_level::class, 'education_level_id');
    }
}
