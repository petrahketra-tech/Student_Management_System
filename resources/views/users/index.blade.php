<x-sms-layout title="User Access">
    <x-slot name="header">User access</x-slot>
    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600"><tr><th class="p-3">Name</th><th class="p-3">Email</th><th class="p-3">Role</th><th class="p-3">Change role</th></tr></thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->getRoleNames()->first() ?? 'none' }}</td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('users.role', $user) }}" class="flex gap-2">
                                @csrf @method('PUT')
                                <select name="role" class="rounded border-gray-300 text-sm">
                                    @foreach (['admin', 'lecturer', 'student'] as $role)
                                        <option value="{{ $role }}" @selected($user->hasRole($role))>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                                <button class="rounded bg-indigo-600 px-3 py-1 text-white">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
</x-sms-layout>
