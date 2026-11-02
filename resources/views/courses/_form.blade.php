@csrf
<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <label for="code" class="mb-1 block text-sm font-medium">Course code</label>
        <input id="code" name="code" value="{{ old('code', $course->code ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label for="credits" class="mb-1 block text-sm font-medium">Credits</label>
        <input id="credits" name="credits" type="number" min="1" max="10" value="{{ old('credits', $course->credits ?? 3) }}" class="w-full rounded border-gray-300">
    </div>
    <div class="sm:col-span-2">
        <label for="title" class="mb-1 block text-sm font-medium">Title</label>
        <input id="title" name="title" value="{{ old('title', $course->title ?? '') }}" class="w-full rounded border-gray-300">
    </div>
    <div class="sm:col-span-2">
        <label for="lecturer_id" class="mb-1 block text-sm font-medium">Lecturer</label>
        <select id="lecturer_id" name="lecturer_id" class="w-full rounded border-gray-300">
            <option value="">-- Unassigned --</option>
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->id }}" @selected(old('lecturer_id', $course->lecturer_id ?? null) == $lecturer->id)>{{ $lecturer->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label for="description" class="mb-1 block text-sm font-medium">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full rounded border-gray-300">{{ old('description', $course->description ?? '') }}</textarea>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Save</button>
    <a href="{{ route('courses.index') }}" class="px-4 py-2 text-gray-600">Cancel</a>
</div>
