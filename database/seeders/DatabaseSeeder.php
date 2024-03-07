<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilSeeder::class);
        $this->call(VisiSeeder::class);
        $this->call(MisiSeeder::class);
        $this->call(AduanSeeder::class);
        $this->call(VASeeder::class);
        $this->call(PanduanSeeder::class);
        
    }
}
