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
            ['BUC3131', 'Advanced Web Application Development', 4, $lecturer1->id],
            ['BUC3130', 'Mobile Application Development', 4, $lecturer1->id],
            ['BUC3126', 'Information Security and Auditing', 3, $lecturer3->id],
            ['BUC2230', 'Business Accounting & Information', 3, $lecturer2->id],
        ];

        foreach ($courses as [$code, $title, $credits, $lecturerId]) {
            Course::firstOrCreate(
                ['code' => $code],
                ['title' => $title, 'credits' => $credits, 'lecturer_id' => $lecturerId]
            );
        }
    }
}
