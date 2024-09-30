<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelasKuliah extends Model
{
    protected $table = 'kelas_kuliah';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = [
        'prodi_id',
        'semester_id',
        'nama_kelas',
        'sks_mk',
        'sks_tm',
        'sks_pr',
        'sks_lap',
        'sks_sim',
        'start_date',
        'end_date',
        'course_id',
        'quota',
        'pn_presensi',
        'pn_tugas',
        'pn_uas',
        'max_pertemuan',
        'min_kehadiran',
        'enrollment_key',
        'grade_status',
        'uts_question',
        'uas_question',
        'class_type',
        'group_class_id',
    ];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(All_prodi::class, 'prodi_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
