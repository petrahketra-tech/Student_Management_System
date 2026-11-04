<x-sms-layout title="Add course unit">
    <x-slot name="header">Add course unit</x-slot>
    <form method="POST" action="{{ route('courses.store') }}" class="max-w-3xl rounded bg-white p-6 shadow">
        @include('courses._form')
    </form>
</x-sms-layout>
