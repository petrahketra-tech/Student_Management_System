<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// creates the admin and the two lecturers (password for all: "password")
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            ['System Administrator', 'admin@mubs.ac.ug', 'admin'],
            ['Dr. Grace Nakato', 'ngrace@mubs.ac.ug', 'lecturer'],
            ['Mr. Bwoye Cannan', 'bcanaan@mubs.ac.ug', 'lecturer'],
            ['Mrs. Mutesi Ritah', 'mritah@mubs.ac.ug', 'lecturer'],
        ];

        foreach ($people as [$name, $email, $role]) {
            // firstOrCreate = create only if this email does not exist yet
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make('sms@26')]
            );
            $user->syncRoles([$role]);
        }
    }
}
