<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_type')->insert([
            ['name' => 'Wajib Prodi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pilihan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wajib Nasional', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Peminatan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Skripsi/Tugas/Akhir/Tesis/Disertasi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
