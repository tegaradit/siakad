<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_type extends Model
{
    use HasFactory;
    protected $table = 'student_type';
    protected $fillable = [
        'name',
    ];
}
