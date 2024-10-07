<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_level')->insert([
            ['id' => '1', 'name' => 'Dosen Tetap Yayasan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'name' => 'Dosen PNS DPK', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '3', 'name' => 'Dosen Tidak Tetap', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '4', 'name' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}