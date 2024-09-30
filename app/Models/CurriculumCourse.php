<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumCourse extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'curriculum_courses';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'curriculum_id',
        'course_id',
        'smt',
        'sks_mk',
        'sks_tm',
        'sks_pr',
        'sks_pl',
        'sks_sim',
        'is_mandatory',
    ];

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id','id');
    }
}
