<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">{{ $classroom->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold dark:text-white">{{ $classroom->name }}</h1>
                    <a href="{{ route('student.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">Back to Classrooms</a>
                </div>

                @if($assignments->count())
                    <div class="space-y-6">
                        @foreach($assignments as $assignment)
                            <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                                <!-- Assignment Header -->
                                <div class="mb-4">
                                    <h3 class="text-2xl font-bold dark:text-white mb-2">{{ $assignment->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <span class="inline-block">Created: {{ $assignment->created_at->format('M d, Y') }}</span>
                                    </p>
                                </div>

                                <!-- Assignment Description -->
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 uppercase">Description</h4>
                                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $assignment->description }}</p>
                                </div>

                                <!-- Assignment File -->
                                @if($assignment->file_path)
                                    <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-4">
                                        <p class="text-sm text-blue-800 dark:text-blue-300 mb-3 font-semibold">📎 Assignment File</p>
                                        <div class="flex gap-2">
                                            <a href="{{ route('student.assignments.file', $assignment) }}" 
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-medium transition-colors">
                                                 View File
                                            </a>
                                            <a href="{{ route('student.assignments.file', $assignment) }}" 
                                               download
                                               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm font-medium transition-colors">
                                                 Download
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <!-- Submission Status -->
                                @php $submission = $assignment->submissions->first(); @endphp

                                @if($submission)
                                    <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg p-4 mb-4">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-xl">✓</span>
                                            <p class="text-green-800 dark:text-green-300 font-semibold">Submitted</p>
                                        </div>
                                        <p class="text-sm text-green-700 dark:text-green-300 mb-1">Submitted on: <strong>{{ $submission->submitted_at->format('M d, Y H:i') }}</strong></p>
                                        
                                        @if($submission->file_path)
                                            <p class="text-sm text-green-700 dark:text-green-300 mb-2">
                                                Submitted file: <strong>{{ basename($submission->file_path) }}</strong>
                                            </p>
                                        @endif

                                        @if($submission->comment)
                                            <div class="mt-3 p-2 bg-white dark:bg-gray-800 rounded border-l-4 border-green-500">
                                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Your Comment:</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $submission->comment }}</p>
                                            </div>
                                        @endif

                                        @if($submission->grade !== null)
                                            <div class="mt-3 p-2 bg-yellow-50 dark:bg-yellow-900 rounded">
                                                <p class="text-sm text-yellow-800 dark:text-yellow-300">
                                                    Grade: <strong class="text-lg">{{ $submission->grade }}/10</strong>
                                                </p>
                                            </div>
                                        @endif

                                        @if($submission->teacher_comment || $submission->grade !== null)
                                            <div class="mt-3 p-3 bg-purple-50 dark:bg-purple-900 rounded border-l-4 border-purple-500">
                                                <p class="text-xs font-semibold text-purple-700 dark:text-purple-300 mb-2">Teacher's Feedback:</p>
                                                @if($submission->teacher_comment)
                                                    <p class="text-sm text-purple-600 dark:text-purple-300">{{ $submission->teacher_comment }}</p>
                                                @else
                                                    <p class="text-sm text-purple-600 dark:text-purple-300">⏳ Waiting for teacher feedback...</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4 mb-4">
                                        <p class="text-yellow-800 dark:text-yellow-300 font-semibold mb-2">⚠️ Not Yet Submitted</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-4">You haven't submitted this assignment yet.</p>
                                    </div>

                                    <a href="{{ route('student.assignments.show', $assignment) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 font-medium transition-colors">
                                        Submit Assignment →
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300 text-center py-8">No assignments in this classroom.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
