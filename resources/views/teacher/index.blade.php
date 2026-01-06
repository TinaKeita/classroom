@foreach($submissions as $submission)
    <div>
        <p>{{ $submission->student->name }}</p>
        <a href="{{ Storage::url($submission->file_path) }}" target="_blank">View file</a>

        <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="grade" value="{{ $submission->grade }}" min="1" max="10">
            <button type="submit">Save grade</button>
        </form>
    </div>
@endforeach
