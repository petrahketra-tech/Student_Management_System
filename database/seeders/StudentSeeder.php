<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// creates 5 students, each with a login account
class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['25/U/15001/PS', 'Aisha Mugerwa', '2500715001@mubs.ac.ug', '0760145678'],
            ['25/U/20452/PS', 'Muyomba Ashiraf Anada', '2500720452@mubs.ac.ug', '0788060789'],
            ['25/U/13703/EVE', 'Namuganyi Desire', '2500713703@mubs.ac.ug', '0729456728'],
            ['25/U/25094/PS', 'Daniel Ssemwogerere', '2500725094@mubs.ac.ug', '0754389056'],
            ['25/U/12035/EVE', 'Nakawoya Sophie', '2500712035@mubs.ac.ug', '0706789005'],
            ['25/U/17006/PS', 'Kigundu Constant', '2500717006@mubs.ac.ug', '0745689043'],
            ['25/U/21207/EVE', 'Anyango Scovia', '2500721207@mubs.ac.ug', '0722567892'],
        ];

        foreach ($students as [$number, $name, $email, $phone]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make('password')]
            );
            $user->syncRoles(['student']);

            Student::firstOrCreate(
                ['student_number' => $number],
                ['user_id' => $user->id, 'name' => $name, 'email' => $email, 'phone' => $phone,]
            );
        }
    }
}
