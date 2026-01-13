<x-app-layout title="Submissions">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-2 dark:text-white">{{ $assignment->title }}</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">{{ Str::limit($assignment->description, 150) }}</p>
        <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
            @if($submissions->count())
                <div class="space-y-3">
                    @foreach($submissions as $submission)
                        <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded p-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold dark:text-white">{{ $submission->student->name }}</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">{{ $submission->submitted_at?->format('M d, Y H:i') ?? 'Not submitted' }}</p>
                                </div>
                                <span class="text-xl font-bold dark:text-white">{{ $submission->grade ?? '-' }}/10</span>
                            </div>
                            @if($submission->comment)
                                <div class="mt-2 p-2 bg-gray-50 dark:bg-gray-600 border-l-4 border-blue-500 dark:border-blue-400 rounded">
                                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Student Comment:</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $submission->comment }}</p>
                                </div>
                            @endif
                            <div class="flex items-center justify-between mt-2">
                                @if($submission->file_path)
                                    <a href="{{ route('teacher.submissions.file', $submission) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">View File</a>
                                @else
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">No file</span>
                                @endif
                                <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="flex gap-1">
                                    @csrf @method('PUT')
                                    <input type="number" name="grade" value="{{ $submission->grade }}" min="0" max="10" class="w-12 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-center dark:bg-gray-600 dark:text-white" />
                                    <button type="submit" class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">Save</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 dark:text-gray-300 py-8">No submissions yet.</p>
            @endif
        </div>
        <div class="mt-4">
            <a href="javascript:history.back()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">Back</a>
        </div>
    </div>
</x-app-layout>
