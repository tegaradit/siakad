<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'course';

    // Add the fillable property
    protected $fillable = [
        'prodi_id',
        'education_level_id',
        'code',
        'name',
        'group_id',
        'type_id',
        'sks_mk',
        'sks_tm',
        'sks_pr',
        'sks_pl',
        'sks_sim',
        'status',
        'is_sap',
        'is_silabus',
        'is_teaching_material',
        'is_praktikum',
        'effective_start_date',
        'effective_end_date',
    ];

    public function all_prodi()
    {
        return $this->belongsTo(All_prodi::class, 'prodi_id', 'id_prodi');
    }

    public function education_level()
    {
        return $this->belongsTo(Education_level::class, 'education_level_id', 'id_jenj_didik');
    }

    public function course_group()
    {
        return $this->belongsTo(Course_group::class, 'group_id', 'id');
    }

    public function course_type()
    {
        return $this->belongsTo(Course_type::class, 'type_id', 'id');
    }
}
