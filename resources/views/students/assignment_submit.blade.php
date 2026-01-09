<x-layout title="Submit assignment">
    <h1>{{ $assignment->title }}</h1>

    <p>{{ $assignment->description }}</p>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('student.assignments.submit', $assignment) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>File</label>
            <input type="file" name="file" required>
        </div>

        <div>
            <label>Comment (optional)</label>
            <textarea name="comment"></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('student.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Dashboard</a>
    </div>
</x-layout>
