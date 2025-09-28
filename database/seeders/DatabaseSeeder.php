<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,      // Jalankan dulu RoleSeeder
            AdminUserSeeder::class, // Lalu AdminUserSeeder
            // Tambahkan seeder lain di sini
        ]);
    }
}
