<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumCourse extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'curriculum_courses';

    // Primary key tipe UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Kolom-kolom yang dapat diisi
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

    // Event model untuk membuat UUID otomatis saat model dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi ke model Curriculum
    public function curriculum()
    {
        return $this->belongsTo(curriculum::class, 'curriculum_id');
    }

    // Relasi ke model Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}