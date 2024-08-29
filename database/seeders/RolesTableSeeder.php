<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SBA (Bag. Akademik)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Keu (Bag. Keuangan)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kaprodi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BA. Jadwal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PMB', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Selector/Verificator', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dosen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pimpinan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staf Akademik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staf Keuangan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
