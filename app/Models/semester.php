<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    protected $primaryKey = 'semester_id';
    public $incrementing = false; // karena primary key bukan auto-increment
    protected $keyType = 'string'; // primary key bertipe char

    protected $fillable = [
        'name',
        'smt',
        'is_active',
        'start_date',
        'end_date'
    ];
}
