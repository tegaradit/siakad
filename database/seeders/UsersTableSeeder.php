<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Get role IDs by role names
        $roles = DB::table('roles')->pluck('id', 'name');

        // Create 12 users
        $users = [
            [
                'name' => 'Admin User',
                'phone_number' => '081234567890',
                'photo' => 'admin_photo.jpg',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Admin'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 1',
                'phone_number' => '081234567891',
                'photo' => 'user1_photo.jpg',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Mahasiswa'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 2',
                'phone_number' => '081234567892',
                'photo' => 'user2_photo.jpg',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Dosen'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 3',
                'phone_number' => '081234567893',
                'photo' => 'user3_photo.jpg',
                'email' => 'user3@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Kaprodi'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 4',
                'phone_number' => '081234567894',
                'photo' => 'user4_photo.jpg',
                'email' => 'user4@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['SBA (Bag. Akademik)'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 5',
                'phone_number' => '081234567895',
                'photo' => 'user5_photo.jpg',
                'email' => 'user5@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['BA. Jadwal'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 6',
                'phone_number' => '081234567896',
                'photo' => 'user6_photo.jpg',
                'email' => 'user6@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['PMB'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 7',
                'phone_number' => '081234567897',
                'photo' => 'user7_photo.jpg',
                'email' => 'user7@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Selector/Verificator'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 8',
                'phone_number' => '081234567898',
                'photo' => 'user8_photo.jpg',
                'email' => 'user8@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Staf Akademik'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 9',
                'phone_number' => '081234567899',
                'photo' => 'user9_photo.jpg',
                'email' => 'user9@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Staf Keuangan'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 10',
                'phone_number' => '081234567900',
                'photo' => 'user10_photo.jpg',
                'email' => 'user10@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Pimpinan'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 11',
                'phone_number' => '081234567901',
                'photo' => 'user11_photo.jpg',
                'email' => 'user11@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Mahasiswa'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 12',
                'phone_number' => '081234567902',
                'photo' => 'user12_photo.jpg',
                'email' => 'user12@example.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['Mahasiswa'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
