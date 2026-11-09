<x-sms-layout title="Courses">
    <x-slot name="header">Courses</x-slot>

    @can('courses.manage')
        <div class="mb-4">
            <a href="{{ route('courses.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Add course</a>
        </div>
    @endcan

    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-3">Code</th><th class="p-3">Course name</th><th class="p-3">lecturer in charge</th>
                    <th class="p-3">Students</th><th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr class="border-t">
                        <td class="p-3">{{ $course->code }}</td>
                        <td class="p-3">{{ $course->title }}</td>
                        <td class="p-3">{{ $course->lecturer ? $course->lecturer->name : '-' }}</td>
                        <td class="p-3">{{ $course->students_count }}</td>
                        <td class="flex gap-3 p-3">
                            <a class="text-indigo-600" href="{{ route('courses.show', $course) }}">View</a>

                            @can('courses.manage')
                                <a class="text-amber-600" href="{{ route('courses.edit', $course) }}">Edit</a>
                                <form method="POST" action="{{ route('courses.destroy', $course) }}"
                                      onsubmit="return confirm('Delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Delete</button>
                                </form>
                            @endcan

                            @can('registrations.create-own')
                                <form method="POST" action="{{ route('registrations.store') }}">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button class="text-green-700 underline">Register</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-center text-gray-500">No courses found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $courses->links() }}</div>
</x-sms-layout>
