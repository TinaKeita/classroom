<x-layout title="Submissions">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-2">{{ $assignment->title }}</h1>
        <p class="text-gray-600 mb-6">{{ Str::limit($assignment->description, 150) }}</p>
        <div class="bg-white shadow rounded p-6">
            @if($submissions->count())
                <div class="space-y-3">
                    @foreach($submissions as $submission)
                        <div class="border border-gray-200 rounded p-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold">{{ $submission->student->name }}</h3>
                                    <p class="text-xs text-gray-600">{{ $submission->submitted_at?->format('M d, Y H:i') ?? 'Not submitted' }}</p>
                                </div>
                                <span class="text-xl font-bold">{{ $submission->grade ?? '-' }}/10</span>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                @if($submission->file_path)
                                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View File</a>
                                @else
                                    <span class="text-gray-500 text-sm">No file</span>
                                @endif
                                <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="flex gap-1">
                                    @csrf @method('PUT')
                                    <input type="number" name="grade" value="{{ $submission->grade }}" min="0" max="10" class="w-12 px-2 py-1 border border-gray-300 rounded text-center" />
                                    <button type="submit" class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700">Save</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 py-8">No submissions yet.</p>
            @endif
        </div>
        <div class="mt-4">
            <a href="javascript:history.back()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back</a>
        </div>
    </div>
</x-layout>
