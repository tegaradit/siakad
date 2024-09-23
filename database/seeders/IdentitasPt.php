<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitasPt extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\IdentitasPt::insert([
            'current_npsn' => 053025,
            'current_id_sp' => '4d31c6cd-2e8e-4144-b954-cb95b6ebd5ce'
        ]);
    }
}
