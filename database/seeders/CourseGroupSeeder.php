<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('active_status')->insert([
            ['name' => 'MPK', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MKK', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MKB', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MPB', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MBB', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
