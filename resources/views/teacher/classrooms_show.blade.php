<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">{{ $classroom->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Info row -->
            <div class="mb-6">
                <p class="text-gray-600">
                    Students: {{ $classroom->students()->count() }}
                </p>
            </div>

            <!-- Join code card -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-2">Join Code</h2>
                <p class="text-sm text-gray-600 mb-3">Share this code with students:</p>
                <p class="text-3xl font-mono font-bold text-blue-600">
                    {{ $classroom->join_code }}
                </p>
            </div>

            <!-- Assignments -->
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Assignments</h2>
                    <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700">
                        + Create
                    </a>
                </div>

                @if($classroom->assignments()->count())
                    <div class="space-y-2">
                        @foreach($classroom->assignments as $assignment)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded">
                                <div>
                                    <h3 class="font-semibold">{{ $assignment->title }}</h3>
                                    <p class="text-xs text-gray-600">
                                        Submissions: {{ $assignment->submissions()->count() }}
                                    </p>
                                </div>
                                <a href="{{ route('teacher.assignments.submissions.index', $assignment) }}"
                                   class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                                    View
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-center py-6">
                        No assignments yet.
                        <a href="{{ route('teacher.classrooms.assignments.create', $classroom) }}"
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            Create one
                        </a>
                    </p>
                @endif
            </div>

            <!-- Back -->
            <div class="mt-6">
                <a href="{{ route('teacher.classrooms.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
