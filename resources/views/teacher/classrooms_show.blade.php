<x-layout title="{{ $classroom->name }}">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-2 dark:text-white">{{ $classroom->name }}</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Students: {{ $classroom->students()->count() }}</p>

        <div class="bg-white dark:bg-gray-800 shadow rounded p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3 dark:text-white">Join Code</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Share this code with students:</p>
            <p class="text-3xl font-mono font-bold text-blue-600 dark:text-blue-400">{{ $classroom->join_code }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold dark:text-white">Assignments</h2>
                <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Create</a>
            </div>
            @if($classroom->assignments()->count())
                <div class="space-y-2">
                    @foreach($classroom->assignments as $assignment)
                        <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded p-3 flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold dark:text-white">{{ $assignment->title }}</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Submissions: {{ $assignment->submissions()->count() }}</p>
                            </div>
                            <a href="{{ route('teacher.assignments.submissions.index', $assignment) }}" class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">View</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-400 text-center py-6">No assignments. <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold">Create one</a></p>
            @endif
        </div>
        <div class="mt-4">
            <a href="{{ route('teacher.classrooms.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to My Classrooms</a>
        </div>
    </div>
</x-layout>