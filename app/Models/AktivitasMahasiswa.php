<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'aktivitas_mahasiswas';
    protected $fillable = [
        'id_reg_pd',
        'semester_id',
        'title',
        'location',
        'sk_number',
        'sk_date',
        'description',
        'activity_type_id'
    ];

    public function mahasiswaPt()
    {
        return $this->belongsTo(MahasiswaPt::class, 'id_reg_pd', 'id_reg_pd');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }

    public function activityType()
    {
        return $this->belongsTo(activity_type::class, 'activity_type_id', 'id'); // Pastikan ini benar
    }
}
