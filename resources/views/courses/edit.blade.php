<x-sms-layout title="Edit course">
    <x-slot name="header">Edit {{ $course->code }}</x-slot>
    <form method="POST" action="{{ route('courses.update', $course) }}" class="max-w-3xl rounded bg-white p-6 shadow">
        @method('PUT')
        @include('courses._form')
    </form>
</x-sms-layout>
