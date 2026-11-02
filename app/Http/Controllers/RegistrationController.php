<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            // admin sees every registration
            $registrations = CourseRegistration::with(['student', 'course'])->latest()->paginate(10);
        } elseif ($user->hasRole('lecturer')) {
            // lecturer sees registrations for their own courses only
            $courseIds = $user->taughtCourses()->pluck('id');
            $registrations = CourseRegistration::with(['student', 'course'])
                ->whereIn('course_id', $courseIds)->latest()->paginate(10);
        } else {
            // student sees only their own registrations
            $studentId = $user->student ? $user->student->id : 0;
            $registrations = CourseRegistration::with(['student', 'course'])
                ->where('student_id', $studentId)->latest()->paginate(10);
        }

        $courses = Course::orderBy('code')->get();
        $students = Student::orderBy('name')->get();

        return view('registrations.index', compact('registrations', 'courses', 'students'));
    }

    // a student registers themselves
    public function store(Request $request)
    {
        $request->validate(['course_id' => 'required|exists:courses,id']);

        $student = auth()->user()->student;
        if (!$student) {
            return back()->with('error', 'Your account has no student record.');
        }

        return $this->register($student->id, $request->course_id);
    }

    // the admin registers a student
    public function storeForStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        return $this->register($request->student_id, $request->course_id);
    }

    public function destroy(CourseRegistration $registration)
    {
        $user = auth()->user();
        $isOwner = $user->student && $user->student->id == $registration->student_id;

        // only the admin or the student who owns the registration can delete it
        if (!$user->hasRole('admin') && !$isOwner) {
            abort(403);
        }

        $registration->delete();

        return back()->with('success', 'Registration removed.');
    }

    // shared by both store methods: checks for a duplicate, then saves
    private function register($studentId, $courseId)
    {
        $exists = CourseRegistration::where('student_id', $studentId)
            ->where('course_id', $courseId)->exists();

        if ($exists) {
            return back()->with('error', 'This student is already registered for that course.');
        }

        CourseRegistration::create(['student_id' => $studentId, 'course_id' => $courseId]);

        return back()->with('success', 'Course registered successfully.');
    }
}
