<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePmb extends Model
{
    use HasFactory;

    protected $table = 'period_pmb';
    protected $primaryKey = 'semester_id';
    public $incrementing = false;
    protected $keyType = 'char';
    public $timestamps = true;

    protected $fillable = [
        'semester_id', 'period_munber',
        'start_date', 'end_date',
        'status'
    ];

}
