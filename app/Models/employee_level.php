<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_level extends Model
{
    use HasFactory;
    protected $table = 'employee_status';
    protected $primaryKey = 'id';
    public $incrementing = false;
    
    protected $fillable = [
        'name'
    ];
}
