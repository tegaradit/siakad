<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecturer extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model
    protected $table = 'lecturer';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'id';

    // Menentukan tipe primary key (string)
    protected $keyType = 'int';

    // Menonaktifkan incrementing, karena nuptk bukan auto-increment
    public $incrementing = true;

    // Menentukan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'nuptk',
        'nidn',
        'nik',
        'gender',
        'name',
        'active_status_id',
        'birth_date',
        'birth_place',
        'mothers_name',
        'mariage_status',
        'employee_level_id',
        'level_education',
        'phone_number',
        'email',
        'assign_letter_number',
        'assign_letter_date',
        'assign_letter_tmt',
        'exit_date',
        'prodi_id',
    ];

    // Relasi ke tabel active_status
    public function ActiveStatus(): BelongsTo
    {
        return $this->belongsTo(Active_status::class, 'active_status_id', 'id');
    }

    // Relasi ke tabel employee_level
    public function employee_level(): BelongsTo
    {
        return $this->belongsTo(Employee_level::class, 'employee_level_id', 'id');
    }

    // Relasi ke tabel t_prodi
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(All_prodi::class, 'prodi_id', 'id');
    }
}