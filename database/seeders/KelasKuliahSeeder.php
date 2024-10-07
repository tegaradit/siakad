<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KelasKuliah;
use Illuminate\Support\Str;

class KelasKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            KelasKuliah::create([
                'id' => Str::uuid(),
                'prodi_id' => Str::uuid(),
                'semester_id' => '202301', // Example semester_id
                'nama_kelas' => 'Kelas ' . $i,
                'sks_mk' => rand(1, 4),
                'sks_tm' => rand(1, 2),
                'sks_pr' => rand(0, 2),
                'sks_lap' => rand(0, 1),
                'sks_sim' => rand(0, 1),
                'start_date' => now()->subMonths(rand(1, 6)),
                'end_date' => now()->addMonths(rand(1, 6)),
                'course_id' => Str::uuid(),
                'quota' => rand(30, 100),
                'pn_presensi' => rand(50, 100) / 10,
                'pn_tugas' => rand(50, 100) / 10,
                'pn_uas' => rand(50, 100) / 10,
                'max_pertemuan' => rand(12, 16),
                'min_kehadiran' => rand(70, 90),
                'enrollment_key' => Str::random(10),
                'grade_status' => rand(0, 1),
                'uts_question' => 'path/to/uts_question_' . $i . '.pdf',
                'uas_question' => 'path/to/uas_question_' . $i . '.pdf',
                'class_type' => (rand(0, 1) ? 'single' : 'group'),
                'group_class_id' => null,
            ]);
        }
    }
}
