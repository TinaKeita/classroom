@foreach($submissions as $submission)
    <div class="p-4 border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded mb-4">
        <p class="font-semibold dark:text-white">{{ $submission->student->name }}</p>
        <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">View file</a>

        <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="mt-3 flex gap-2 items-center">
            @csrf
            @method('PUT')
            <input type="number" name="grade" value="{{ $submission->grade }}" min="1" max="10" class="w-16 px-2 py-1 border border-gray-300 dark:border-gray-600 dark:bg-gray-600 dark:text-white rounded">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600">Save grade</button>
        </form>
    </div>
@endforeach
