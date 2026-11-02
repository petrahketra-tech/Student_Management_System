<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseRegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // student number => the course codes they register for
        $plan = [
            '2026/BBC/001' => ['BUC3131', 'BUC3130', 'BUC2230'],
            '2026/BBC/002' => ['BUC3131', 'BUC3126'],
            '2026/BBC/003' => ['BUC3130', 'BUC3126', 'BUC2230'],
            '2026/BBC/004' => ['BUC3131'],
            '2026/BBC/005' => ['BUC3131', 'BUC3130'],
        ];

        foreach ($plan as $number => $codes) {
            $student = Student::where('student_number', $number)->first();

            foreach ($codes as $code) {
                $course = Course::where('code', $code)->first();

                // firstOrCreate on the pair means no duplicates when seeding again
                CourseRegistration::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
