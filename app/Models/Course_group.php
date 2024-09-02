<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_group extends Model
{
    use HasFactory;
    protected $table = 'active_status';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name'
    ];
}
