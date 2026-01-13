<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">{{ $classroom->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Students section -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold mb-1 dark:text-white">Students</h2>
                        <p class="text-gray-600 dark:text-gray-300">{{ $classroom->students()->count() }} student(s) in this classroom</p>
                    </div>
                    <a href="{{ route('teacher.classrooms.students', $classroom) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold text-sm hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
                        View Students
                    </a>
                </div>
            </div>

            <!-- Join code card -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-2 dark:text-white">Join Code</h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Share this code with students:</p>
                <p class="text-3xl font-mono font-bold text-blue-600 dark:text-blue-400">
                    {{ $classroom->join_code }}
                </p>
            </div>

            <!-- Assignments -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold dark:text-white">Assignments</h2>
                    <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700 dark:bg-blue-700 dark:border-blue-600 dark:text-white dark:hover:bg-blue-800">
                        + Create
                    </a>
                </div>

                @if($classroom->assignments()->count())
                    <div class="space-y-2">
                        @foreach($classroom->assignments as $assignment)
                            <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded">
                                <div>
                                    <h3 class="font-semibold dark:text-white">{{ $assignment->title }}</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">
                                        Submissions: {{ $assignment->submissions()->count() }}
                                    </p>
                                </div>
                                <a href="{{ route('teacher.assignments.submissions.index', $assignment) }}"
                                   class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">
                                    View
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300 text-center py-6">
                        No assignments yet.
                        <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}"
                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold">
                            Create one
                        </a>
                    </p>
                @endif
            </div>

            <!-- Back -->
            <div class="mt-6">
                <a href="{{ route('teacher.classrooms.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                    Back
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
