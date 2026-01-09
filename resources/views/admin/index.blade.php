<x-layout :title="'Admin Dashboard'">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h1>
            <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create User</a>
        </div>

        @if($users->count())
            <div class="bg-white dark:bg-gray-800 shadow rounded overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-3 text-sm text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-6 py-3 text-sm text-gray-900 dark:text-white">{{ $user->email }}</td>
                            <td class="px-6 py-3 text-sm text-gray-900 dark:text-white">{{ $user->role }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6 text-center">
                <p class="text-gray-600 dark:text-gray-400">No users. <a href="{{ route('admin.create') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold">Create one</a></p>
            </div>
        @endif
    </div>
</x-layout>
