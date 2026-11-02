<x-sms-layout title="Edit student">
    <x-slot name="header">Edit {{ $student->name }}</x-slot>
    <form method="POST" action="{{ route('students.update', $student) }}" class="max-w-3xl rounded bg-white p-6 shadow">
        @method('PUT')
        @include('students._form')
    </form>
</x-sms-layout>
