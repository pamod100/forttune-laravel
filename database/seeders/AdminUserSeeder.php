<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates the very first admin account so you can log into /admin
     * right after running migrations. CHANGE THIS PASSWORD after first login.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@forttune.lk'],
            [
                'name' => 'Forttune Admin',
                'password' => Hash::make('Forttune@2026'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
