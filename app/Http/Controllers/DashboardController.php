<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();   // the logged in user
        $stats = [];

        if ($user->hasRole('admin')) {
            $stats['Students'] = Student::count();
            $stats['Courses'] = Course::count();
            $stats['Registrations'] = CourseRegistration::count();
            $stats['Users'] = User::count();
        } elseif ($user->hasRole('lecturer')) {
            $stats['My courses'] = $user->taughtCourses()->count();
        } elseif ($user->hasRole('student')) {
            $stats['Available courses'] = Course::count();
            $stats['My registrations'] = $user->student ? $user->student->registrations()->count() : 0;
        }

        return view('dashboard', compact('stats'));
    }
}
