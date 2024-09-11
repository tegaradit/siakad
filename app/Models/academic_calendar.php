<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_calendar extends Model
{
    use HasFactory;
    protected $table = 'academic_calendars';
    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'semester_id',
        'calendar_type_id',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }

    public function calendar_type()
    {
        return $this->belongsTo(Calendar_type::class, 'calendar_type_id', 'id');
    }
}
