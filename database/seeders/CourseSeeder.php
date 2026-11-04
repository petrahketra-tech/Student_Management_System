<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $lecturer1 = User::where('email', 'ngrace@mubs.ac.ug')->first();
        $lecturer2 = User::where('email', 'bcanaan@mubs.ac.ug')->first();
        $lecturer3 = User::where('email', 'mritah@mubs.ac.ug')->first();

        $courses = [
            ['BBC', 'Bachelor of Business Computing', $lecturer1->id],
            ['BBA', 'Bachelor of Business Administration', $lecturer2->id],
            ['PROC', 'Bachelors in Procurement and Logistics Management', $lecturer3->id],
            ['BSA', 'Bachelor of Science in accounting', $lecturer2->id],
            ['LEIS', 'Bachelor in Leisure and Hospitality Management', $lecturer3->id],
            ['BCS', 'Bachelor in Computer Science', $lecturer1->id],
        ];

        foreach ($courses as [$code, $title, $lecturerId]) {
            Course::firstOrCreate(
                ['code' => $code],
                ['title' => $title, 'lecturer_id' => $lecturerId]
            );
        }
    }
}
