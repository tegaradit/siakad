<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_year extends Model
{
    use HasFactory;

    protected $table = 'academic_years';
    protected $fillable = [
        'id', // jika ingin mengatur ID secara manual
        'name',
        'start_date',
        'end_date',
    ];
    
}
