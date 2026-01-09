<x-layout title="My Classrooms">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold dark:text-white">My Classrooms</h1>
            <a href="{{ route('teacher.classrooms.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</a>
        </div>
        @if($classrooms->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($classrooms as $classroom)
                    <div class="bg-white dark:bg-gray-800 shadow rounded p-4">
                        <h2 class="text-lg font-semibold mb-2 dark:text-white">{{ $classroom->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Code: <span class="font-mono font-bold dark:text-blue-400">{{ $classroom->join_code }}</span></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Students: {{ $classroom->students()->count() }}</p>
                        <a href="{{ route('teacher.classrooms.show', $classroom) }}" class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">View</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6 text-center">
                <p class="text-gray-600 dark:text-gray-400">No classrooms. <a href="{{ route('teacher.classrooms.create') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold">Create one</a></p>
            </div>
        @endif
    </div>
</x-layout>
