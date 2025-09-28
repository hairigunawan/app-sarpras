<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator System'],
            ['name' => 'free_user', 'description' => 'Free User'],
            ['name' => 'premium_user', 'description' => 'Premium User'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }

        $this->command->info('Roles berhasil dibuat: ' . implode(', ', array_column($roles, 'name')));
    }
}
