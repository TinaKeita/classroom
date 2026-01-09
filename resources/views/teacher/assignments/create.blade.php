<x-app-layout title="Create Assignment">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Create Assignment - {{ $classroom->name }}</h1>
        <div class="bg-white shadow rounded p-6">
            <form action="{{ route('teacher.classrooms.assignments.store', $classroom) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" required value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded" />
                    @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" required rows="4" class="w-full px-3 py-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">File (Optional)</label>
                    <input type="file" name="file" class="w-full px-3 py-2 border border-gray-300 rounded" />
                    @error('file')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
                    <a href="{{ route('teacher.classrooms.show', $classroom) }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
