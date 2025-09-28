<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // [1] Cari role admin
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Role admin tidak ditemukan! Pastikan RoleSeeder sudah dijalankan.');
            return;
        }

        // [2] Cek apakah user admin sudah ada
        $existingAdmin = User::where('email', 'admin@example.com')->first();

        if ($existingAdmin) {
            $this->command->info('User admin sudah ada. Mengupdate data...');

            $existingAdmin->update([
                'name' => 'Administrator',
                'role_id' => $adminRole->id,
                'password' => Hash::make('password123'), // Reset password
            ]);

            $this->command->info('User admin berhasil diupdate!');
            return;
        }

        // [3] Buat user admin baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Password default
            'role_id' => $adminRole->id,
            'email_verified_at' => now(), // Verifikasi email otomatis
        ]);

        $this->command->info('User admin berhasil dibuat!');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password123');
    }
}
