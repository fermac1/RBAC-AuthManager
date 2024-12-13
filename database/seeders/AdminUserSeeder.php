<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingUser = User::where('email', 'superadmin@email.com')->first();

        // If the user exists, delete it
        if ($existingUser) {
            $existingUser->delete();
        }

        $adminRole = Role::find(1);

        User::create([
            'name' => 'Administrator',
            'email' => 'superadmin@email.com',
            'password' => bcrypt('SuperSecretPassword'),
            'email_verified_at' => now(),
            'role_id' => $adminRole->id,
        ]);
    }
}
