<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    use HasUuids;

    public function t_prodi()
    {
        return $this->belongsTo(t_prodi::class,'prodi_id');
    }

    public function education_level()
    {
        return $this->hasMany(education_level::class,'education_level_id');
    }

    public function course_group()
    {
        return $this->hasOne(course_group::class,'group_id');
    }

    public function course_type()
    {
        return $this->hasOne(course_type::class,'type_id');
    }

}
