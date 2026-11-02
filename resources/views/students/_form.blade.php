@csrf
<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <label for="student_number" class="mb-1 block text-sm font-medium">Student number</label>
        <input id="student_number" name="student_number" type="text"
               value="{{ old('student_number', $student->student_number ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label for="name" class="mb-1 block text-sm font-medium">Full name</label>
        <input id="name" name="name" type="text"
               value="{{ old('name', $student->name ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label for="email" class="mb-1 block text-sm font-medium">Email</label>
        <input id="email" name="email" type="email"
               value="{{ old('email', $student->email ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label for="phone" class="mb-1 block text-sm font-medium">Phone</label>
        <input id="phone" name="phone" type="text"
               value="{{ old('phone', $student->phone ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label for="program" class="mb-1 block text-sm font-medium">Programme</label>
        <input id="program" name="program" type="text"
               value="{{ old('program', $student->program ?? 'Bachelor of Business Computing') }}" class="w-full rounded border-gray-300">
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Save</button>
    <a href="{{ route('students.index') }}" class="px-4 py-2 text-gray-600">Cancel</a>
</div>
