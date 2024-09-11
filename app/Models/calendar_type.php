<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar_type extends Model
{
    use HasFactory;
    protected $table = 'calendar_types';
    protected $fillable = [
        'name',
    ];
}
