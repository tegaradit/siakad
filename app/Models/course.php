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

    public function t_prodi()
    {
        return $this->belongsTo(Prodi::class,'prodi_id');
    }

    public function education_level()
    {
        return $this->hasMany(Education_level::class,'education_level_id');
    }

    public function course_group()
    {
        return $this->hasOne(Course_group::class,'group_id');
    }

    public function course_type()
    {
        return $this->hasOne(course_type::class,'type_id');
    }

}
