<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">{{ $classroom->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold dark:text-white">{{ $classroom->name }}</h1>
                    <a href="{{ route('student.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Classrooms</a>
                </div>

                @if($assignments->count())
                    <div class="space-y-4">
                        @foreach($assignments as $assignment)
                            <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded p-4">
                                <h3 class="text-lg font-semibold mb-2 dark:text-white">{{ $assignment->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($assignment->description, 200) }}</p>
                                
                                @php $submission = $assignment->submissions->first(); @endphp
                                
                                @if($submission)
                                    <div class="bg-green-50 border border-green-200 rounded p-3 mb-3">
                                        <p class="text-green-800 font-semibold">✓ Submitted</p>
                                        <p class="text-sm text-green-700">On: {{ $submission->created_at->format('M d, Y H:i') }}</p>
                                        @if($submission->grade)
                                            <p class="text-sm text-green-700">Grade: <span class="font-bold">{{ $submission->grade }}/10</span></p>
                                        @endif
                                    </div>
                                @else
                                    <a href="{{ route('student.assignments.show', $assignment) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">Submit Assignment</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-center py-8">No assignments in this classroom.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
