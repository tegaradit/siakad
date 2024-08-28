<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'code',
        'name',
        'floor_position',
        'building_id',
        'capacity',
    ];
}