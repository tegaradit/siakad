<?php

namespace Database\Seeders;

use App\Models\Periode_pmb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodPmbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date_create("now"); // Get the current date
        date_add($date, date_interval_create_from_date_string("1 month"));

        Periode_pmb::insert([
            'semester_id' => '20241',
            'period_number' => 1,
            'start_date' => now(),
            'end_date' => $date,
            'status' => 1
        ]);
    }
}
