<x-sms-layout title="Registrations">
    <x-slot name="header">Course registrations</x-slot>

    {{-- admin form: choose a student and a course --}}
    @can('registrations.manage')
        <form method="POST" action="{{ route('registrations.admin-store') }}"
              class="mb-6 flex flex-wrap items-end gap-3 rounded bg-white p-4 shadow">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-medium">Student</label>
                <select name="student_id" class="rounded border-gray-300">
                    <option value="">-- choose --</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->student_number }} - {{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Course</label>
                <select name="course_id" class="rounded border-gray-300">
                    <option value="">-- choose --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <button class="rounded bg-indigo-600 px-4 py-2 text-white">Register student</button>
        </form>
    @endcan

    {{-- student form: only choose a course --}}
    @can('registrations.create-own')
        <form method="POST" action="{{ route('registrations.store') }}"
              class="mb-6 flex flex-wrap items-end gap-3 rounded bg-white p-4 shadow">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-medium">Register for a course</label>
                <select name="course_id" class="rounded border-gray-300">
                    <option value="">-- choose --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <button class="rounded bg-green-600 px-4 py-2 text-white">Register</button>
        </form>
    @endcan

    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-3">Student</th>
                    <th class="p-3">Course</th>
                    <th class="p-3">Registered on</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr class="border-t">
                        <td class="p-3">{{ $registration->student->name }}</td>
                        <td class="p-3">{{ $registration->course->code }} - {{ $registration->course->title }}</td>
                        <td class="p-3">{{ $registration->created_at->format('d M Y') }}</td>
                        <td class="p-3">
                            @hasanyrole('admin|student')
                                <form method="POST" action="{{ route('registrations.destroy', $registration) }}"
                                      onsubmit="return confirm('Remove this registration?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Drop</button>
                                </form>
                            @endhasanyrole
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4 text-center text-gray-500">No registrations to show.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $registrations->links() }}</div>
</x-sms-layout>
