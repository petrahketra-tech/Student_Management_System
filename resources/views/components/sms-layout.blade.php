@props(['title' => 'Home'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | Student Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-gray-100 text-gray-800">

    {{-- header --}}
    <header class="bg-indigo-700 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">MUBS Student Management System</a>
            <div class="flex items-center gap-4 text-sm">
                <span>{{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline">Log out</button>
                </form>
            </div>
        </div>
    </header>

    {{-- navigation: each link only shows if the user has the permission --}}
    <nav class="border-b bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl gap-6 px-4 py-3 text-sm font-medium">
            <a href="{{ route('dashboard') }}">Dashboard</a>

            @can('students.manage')
                <a href="{{ route('students.index') }}">Students</a>
            @endcan

            @canany(['courses.manage', 'courses.view-assigned', 'courses.view-available'])
                <a href="{{ route('courses.index') }}">Courses</a>
            @endcanany

            @canany(['registrations.manage', 'registrations.view-own', 'courses.view-assigned'])
                <a href="{{ route('registrations.index') }}">Registrations</a>
            @endcanany

            @can('users.manage')
                <a href="{{ route('users.index') }}">User Access</a>
            @endcan

            <a href="{{ route('profile.show') }}">Profile</a>
        </div>
    </nav>

    {{-- content --}}
    <main class="flex-1">
        <div class="mx-auto max-w-7xl px-4 py-6">
            @isset($header)
                <h1 class="mb-6 text-2xl font-semibold">{{ $header }}</h1>
            @endisset

            <x-flash />

            {{ $slot }}
        </div>
    </main>

    {{-- footer --}}
    <footer class="border-t bg-white py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Makerere University Business School
    </footer>
</body>
</html>
