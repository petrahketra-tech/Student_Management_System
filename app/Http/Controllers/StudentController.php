<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Only the admin can reach these routes (permission:students.manage in routes/web.php)
class StudentController extends Controller
{
    public function index()
    {
        $students = Student::withCount('courses')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_number' => 'required|max:50|unique:students,student_number',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email|unique:users,email',
            'phone' => 'nullable|max:20',
        ]);

        // create a login account for the student first
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('student');

        // then the student record linked to that account
        $data['user_id'] = $user->id;
        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student added. Their password is "password".');
    }

    public function show(Student $student)
    {
        $courses = $student->courses;
        return view('students.show', compact('student', 'courses'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_number' => 'required|max:50|unique:students,student_number,' . $student->id,
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id . '|unique:users,email,' . $student->user_id,
            'phone' => 'nullable|max:20',
        ]);

        $student->update($data);

        // keep the login account in step with the student record
        if ($student->user) {
            $student->user->update(['name' => $data['name'], 'email' => $data['email']]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $user = $student->user;
        $student->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
