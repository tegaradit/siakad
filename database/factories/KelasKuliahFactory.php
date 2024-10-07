<?php

namespace Database\Factories;

use App\Models\KelasKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KelasKuliahFactory extends Factory
{
    protected $model = KelasKuliah::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'prodi_id' => Str::uuid(),
            'semester_id' => '202301',
            'nama_kelas' => 'Kelas ' . $this->faker->word,
            'sks_mk' => rand(1, 4),
            'sks_tm' => rand(1, 2),
            'sks_pr' => rand(0, 2),
            'sks_lap' => rand(0, 1),
            'sks_sim' => rand(0, 1),
            'start_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'course_id' => Str::uuid(),
            'quota' => rand(30, 100),
            'pn_presensi' => rand(50, 100) / 10,
            'pn_tugas' => rand(50, 100) / 10,
            'pn_uas' => rand(50, 100) / 10,
            'max_pertemuan' => rand(12, 16),
            'min_kehadiran' => rand(70, 90),
            'enrollment_key' => Str::random(10),
            'grade_status' => rand(0, 1),
            'uts_question' => 'path/to/uts_question_' . rand(1, 10) . '.pdf',
            'uas_question' => 'path/to/uas_question_' . rand(1, 10) . '.pdf',
            'class_type' => (rand(0, 1) ? 'single' : 'group'),
            'group_class_id' => null,
        ];
    }
}
