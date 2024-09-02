<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_level extends Model
{
    use HasFactory;
    protected $table = 'employee_status';
    protected $fillable = [
        'name'
    ];
}
