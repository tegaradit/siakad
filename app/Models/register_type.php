<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register_type extends Model
{
    use HasFactory;
    protected $table = 'register_types';
    protected $fillable = [
        'name',
    ];
}
