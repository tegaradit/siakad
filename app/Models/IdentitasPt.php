<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasPt extends Model
{
    use HasFactory;
    protected $table = 'identitas_pt';
    protected $primaryKey = 'id';

    protected $fillable = [ 'current_npsn', 'current_id_sp' ];
}
