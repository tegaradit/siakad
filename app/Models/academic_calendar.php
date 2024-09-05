<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class academic_calendar extends Model
{
    use HasFactory;
    protected $fillable =[
        'start_date',
        'end_date',
        'description',
        'semester_id',
        'calendar_type_id',
    ];
}
