<x-sms-layout title="Dashboard">
    <x-slot name="header">Welcome, {{ auth()->user()->name }}</x-slot>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($stats as $label => $value)
            <div class="rounded bg-white p-6 shadow">
                <p class="text-sm text-gray-500">{{ $label }}</p>
                <p class="text-3xl font-bold text-indigo-700">{{ $value }}</p>
            </div>
        @endforeach
    </div>
</x-sms-layout>
