<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveStatus extends Model
{
    use HasFactory;
    protected $table = 'active_status';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'name'
    ];
}
