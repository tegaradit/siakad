<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_type extends Model
{
    use HasFactory;
    protected $table = 'course_type';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name'
    ];
}
