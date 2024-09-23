<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        $this->call([
            ActiveStatusSeeder::class,
            IdentitasPt::class,
            CourseTypeSeeder::class,
            CourseGroupSeeder::class,
            EmployeeLevelSeeder::class
        ]);
    }
}
