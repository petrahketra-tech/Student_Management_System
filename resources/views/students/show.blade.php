<x-sms-layout title="Student details">
    <x-slot name="header">{{ $student->name }}</x-slot>

    <div class="mb-6 rounded bg-white p-6 shadow">
        <p><strong>Student number:</strong> {{ $student->student_number }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone:</strong> {{ $student->phone ?? '-' }}</p>
    </div>

    <h2 class="mb-2 text-lg font-semibold">Registered courses</h2>
    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50">
                <tr><th class="p-3">Code</th><th class="p-3">Course name</th><th class="p-3">Registered on</th></tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr class="border-t">
                        <td class="p-3">{{ $course->code }}</td>
                        <td class="p-3">{{ $course->title }}</td>
                        <td class="p-3">{{ $course->pivot->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center text-gray-500">Not registered for any course.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('students.index') }}" class="mt-4 inline-block text-indigo-600">Back</a>
</x-sms-layout>
