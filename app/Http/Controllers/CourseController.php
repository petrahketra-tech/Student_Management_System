<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('lecturer')) {
            // a lecturer only sees the courses assigned to them
            $courses = Course::with('lecturer')->withCount('students')
                ->where('lecturer_id', $user->id)->paginate(10);
        } else {
            $courses = Course::with('lecturer')->withCount('students')->paginate(10);
        }

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $user = auth()->user();

        // a lecturer must not open another lecturer's course
        if ($user->hasRole('lecturer') && $course->lecturer_id != $user->id) {
            abort(403);
        }

        // only admin and lecturer can see the registered students
        $students = null;
        if ($user->hasRole('admin') || $user->hasRole('lecturer')) {
            $students = $course->students;
        }

        return view('courses.show', compact('course', 'students'));
    }

    public function create()
    {
        $lecturers = User::role('lecturer')->get();
        return view('courses.create', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|max:20|unique:courses,code',
            'title' => 'required|max:255',
            'description' => 'nullable|max:2000',
            'lecturer_id' => 'nullable|exists:users,id',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $lecturers = User::role('lecturer')->get();
        return view('courses.edit', compact('course', 'lecturers'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'code' => 'required|max:20|unique:courses,code,' . $course->id,
            'title' => 'required|max:255',
            'description' => 'nullable|max:2000',
            'lecturer_id' => 'nullable|exists:users,id',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }
}
