<x-layout title="My Classrooms">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">My Classrooms</h1>
            <a href="{{ route('teacher.classrooms.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                Create Classroom
            </a>
        </div>

        @if($classrooms->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($classrooms as $classroom)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-xl font-semibold mb-2">{{ $classroom->name }}</h2>
                            <p class="text-sm text-gray-600 mb-4">Join Code: <span class="font-mono font-bold">{{ $classroom->join_code }}</span></p>
                            <p class="text-sm text-gray-600 mb-4">Students: {{ $classroom->students()->count() }}</p>
                            <a href="{{ route('teacher.classrooms.show', $classroom) }}" class="inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <p class="text-lg">No classrooms yet. <a href="{{ route('teacher.classrooms.create') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Create one now</a></p>
                </div>
            </div>
        @endif
    </div>
</x-layout>
