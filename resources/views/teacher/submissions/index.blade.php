<x-app-layout title="Submissions">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-2 dark:text-white">{{ $assignment->title }}</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">{{ Str::limit($assignment->description, 150) }}</p>
        <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
            @if($submissions->count())
                <div class="space-y-4">
                    @foreach($submissions as $submission)
                        <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h3 class="font-semibold dark:text-white">{{ $submission->student->name }}</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">{{ $submission->submitted_at?->format('M d, Y H:i') ?? 'Not submitted' }}</p>
                                </div>
                                <span class="text-xl font-bold dark:text-white">{{ $submission->grade ?? '-' }}/10</span>
                            </div>

                            @if($submission->file_path)
                                <div class="mb-3">
                                    <a href="{{ route('teacher.submissions.file', $submission) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">📎 View Submitted File</a>
                                </div>
                            @endif
                            @if($submission->comment)
                                <div class="mt-2 p-2 bg-gray-50 dark:bg-gray-600 border-l-4 border-blue-500 dark:border-blue-400 rounded">
                                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Student Comment:</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $submission->comment }}</p>
                                </div>
                            @endif

                            <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="mt-4 space-y-3">
                                @csrf @method('PUT')
                                
                                <div class="flex items-end gap-2">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Grade (0-10)</label>
                                        <input type="number" name="grade" value="{{ $submission->grade }}" min="0" max="10" class="w-16 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-center dark:bg-gray-600 dark:text-white" />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Your Feedback (optional)</label>
                                    <textarea name="teacher_comment" rows="3" class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-600 dark:text-white text-sm" placeholder="Add your feedback here...">{{ $submission->teacher_comment }}</textarea>
                                </div>

                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 font-semibold">Save Grade & Feedback</button>
                            </form>
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
