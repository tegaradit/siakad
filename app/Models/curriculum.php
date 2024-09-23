<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curriculum extends Model
{
    use HasFactory;
    // Menentukan tabel yang digunakan oleh model
    protected $table = 'curriculum';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'curriculum_id';

    // Menentukan tipe primary key (UUID)
    protected $keyType = 'string';

    // Menonaktifkan incrementing, karena UUID bukan auto-increment
    public $incrementing = false;

    // Menentukan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'curriculum_id',
        'prodi_id',
        'education_level_id',
        'semester_id',
        'name',
        'normal_semester_number',
        'pass_credit_number',
        'mandatory_credit_number',
        'choice_credit_number',
    ];

    // Relasi ke tabel t_prodi
    public function all_prodi(): BelongsTo
    {
        return $this->belongsTo(All_prodi::class, 'prodi_id', 'id_prodi');
    }

    // Relasi ke tabel education_level
    public function education_level(): BelongsTo
    {
        return $this->belongsTo(Education_level::class, 'education_level_id', 'id_jenj_didik');
    }

    // Relasi ke tabel semester
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
