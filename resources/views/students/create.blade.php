<x-sms-layout title="Add student">
    <x-slot name="header">Add student</x-slot>
    <form method="POST" action="{{ route('students.store') }}" class="max-w-3xl rounded bg-white p-6 shadow">
        @include('students._form')
    </form>
</x-sms-layout>
