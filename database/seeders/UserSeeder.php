<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk database.
     */
    public function run(): void
    {
        // Membuat pengguna dengan role Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole('admin');

        // Membuat pengguna dengan role User
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'username' => 'user',
                'password' => Hash::make('password123'),

            ]
        );
        $user->assignRole('user');

        // Membuat pengguna dengan role Owner
        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Owner User',
                'username' => 'owner',
                'password' => Hash::make('password123'),

            ]
        );
        $owner->assignRole('owner');

        $this->command->info('Pengguna dengan role admin, user, dan owner berhasil dibuat!');
    }
}
