<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosenMengajar extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'dosen_mengajar';

    // Primary key of the table
    protected $primaryKey = 'id';

    // Attributes that are mass assignable
    protected $fillable = [
        'lecture_id',
        'class_id',
        'number_of_tm_plan',
        'number_of_tm_real',
        'rps_doc',
    ];

    // Relationships
    /**
     * Relationship to the Lecturer model.
     * Assuming 'lecture_id' is foreign key to 'lecturer' table
     */
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecture_id', 'id');
    }

    /**
     * Relationship to the KelasKuliah model.
     * Assuming 'class_id' is foreign key to 'kelas_kuliah' table
     */
    public function kelasKuliah()
    {
        return $this->belongsTo(KelasKuliah::class, 'class_id', 'id');
    }

    // Accessor for RPS document URL
    public function getRpsDocUrlAttribute()
    {
        return url('storage/rps_docs/' . $this->rps_doc);
    }
}
