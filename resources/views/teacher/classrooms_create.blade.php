<x-layout title="Create classroom">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Create New Classroom</h1>

        <div class="bg-white dark:bg-gray-800 shadow rounded p-6 max-w-2xl">
            <form action="{{ route('teacher.classrooms.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Classroom Name</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('name')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Classroom</button>
            </form>
        </div>
    </div>
</x-layout>