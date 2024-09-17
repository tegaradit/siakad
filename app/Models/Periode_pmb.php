<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode_pmb extends Model
{
    use HasFactory;

    protected $table = 'period_pmb';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'semester_id', 'period_number',
        'start_date', 'end_date',
        'status'
    ];

    function semester () {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
