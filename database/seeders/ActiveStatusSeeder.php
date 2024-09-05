<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('active_status')->insert([
            ['id' => '1', 'name' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'name' => 'Tidak Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '20', 'name' => 'Cuti', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '24', 'name' => 'Ijin Belajar', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '25', 'name' => 'Tugas di Instansi Lain', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '27', 'name' => 'Tugas Belajar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
