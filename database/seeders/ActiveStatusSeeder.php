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
            ['id' => '1', 'name' => 'Aktif'],
            ['id' => '2', 'name' => 'Tidak Aktif'],
            ['id' => '20', 'name' => 'Cuti'],
            ['id' => '24', 'name' => 'Ijin Belajar'],
            ['id' => '25', 'name' => 'Tugas di Instansi Lain'],
            ['id' => '27', 'name' => 'Tugas Belajar'],
        ]);
    }
}
