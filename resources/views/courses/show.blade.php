<x-sms-layout title="Course details">
    <x-slot name="header">{{ $course->code }} - {{ $course->title }}</x-slot>

    <div class="mb-6 rounded bg-white p-6 shadow">
        <p><strong>Credits:</strong> {{ $course->credits }}</p>
        <p><strong>Lecturer:</strong> {{ $course->lecturer ? $course->lecturer->name : 'Not assigned' }}</p>
        <p class="mt-2">{{ $course->description ?? 'No description.' }}</p>

        @can('registrations.create-own')
            <form method="POST" action="{{ route('registrations.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <button class="rounded bg-green-600 px-4 py-2 text-white">Register for this course</button>
            </form>
        @endcan
    </div>

    {{-- $students is null for a student, so this table is hidden from them --}}
    @if ($students)
        <h2 class="mb-2 text-lg font-semibold">Registered students ({{ $students->count() }})</h2>
        <div class="overflow-x-auto rounded bg-white shadow">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50">
                    <tr><th class="p-3">Number</th><th class="p-3">Name</th><th class="p-3">Email</th></tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="border-t">
                            <td class="p-3">{{ $student->student_number }}</td>
                            <td class="p-3">{{ $student->name }}</td>
                            <td class="p-3">{{ $student->email }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="p-4 text-center text-gray-500">No students registered yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('courses.index') }}" class="mt-4 inline-block text-indigo-600">Back</a>
</x-sms-layout>
