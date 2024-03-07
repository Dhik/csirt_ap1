<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_user' => 'Admin',
                'nama_user' => 'Admin 1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('123456'),
                'status' => 'Aktif'
            ],
            [
                'role_user' => 'Pimpinan',
                'nama_user' => 'Pimpinan 1',
                'email' => 'pimpinan1@gmail.com',
                'password' => Hash::make('123456'),
                'status' => 'Aktif'
            ],
            [
                'role_user' => 'Pelapor',
                'nama_user' => 'Pelapor 1',
                'email' => 'pelapor1@gmail.com',
                'password' => Hash::make('123456'),
                'status' => 'Aktif'
            ],
            [
                'role_user' => 'Superuser',
                'nama_user' => 'Super User 1',
                'email' => 'superuser@gmail.com',
                'password' => Hash::make('123456'),
                'status' => 'Aktif'
            ],
            [
                'role_user' => 'Narahubung',
                'nama_user' => 'Narahubung 1',
                'email' => 'narahubung@gmail.com',
                'password' => Hash::make('123456'),
                'status' => 'Aktif'
            ],
        ]);
    }
}
