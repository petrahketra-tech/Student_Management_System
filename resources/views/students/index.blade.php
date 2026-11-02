<x-sms-layout title="Students">
    <x-slot name="header">Students</x-slot>
    <div class="mb-4"><a href="{{ route('students.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">+ Add student</a></div>

    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr><th class="p-3">Number</th><th class="p-3">Name</th><th class="p-3">Email</th><th class="p-3">Courses</th><th class="p-3">Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="border-t">
                        <td class="p-3">{{ $student->student_number }}</td>
                        <td class="p-3">{{ $student->name }}</td>
                        <td class="p-3">{{ $student->email }}</td>
                        <td class="p-3">{{ $student->courses_count }}</td>
                        <td class="flex gap-3 p-3">
                            <a class="text-indigo-600" href="{{ route('students.show', $student) }}">View</a>
                            <a class="text-amber-600" href="{{ route('students.edit', $student) }}">Edit</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-gray-500">No students yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $students->links() }}</div>
</x-sms-layout>
