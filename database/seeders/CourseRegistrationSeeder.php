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
            '25/U/15001/PS' => ['BBC'],
            '25/U/20452/PS' => ['BBA'],
            '25/U/13703/EVE' => ['PROC'],
            '25/U/25094/PS' => ['BSA'],
            '25/U/12035/EVE' => ['LEIS'],
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
