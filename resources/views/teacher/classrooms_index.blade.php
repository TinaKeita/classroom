<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">My Classrooms</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header actions -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('teacher.classrooms.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700 dark:bg-blue-700 dark:border-blue-600 dark:text-white dark:hover:bg-blue-800">
                    Create Classroom
                </a>
            </div>

            <!-- Classrooms -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">My Classrooms</h2>

                @if($classrooms->count())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($classrooms as $classroom)
                            <div class="border border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg dark:text-white">{{ $classroom->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                        Code: <span class="font-mono font-bold">{{ $classroom->join_code }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        Students: {{ $classroom->students()->count() }}
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('teacher.classrooms.show', $classroom) }}"
                                       class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">
                                        View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300 text-center py-6">
                        No classrooms yet.
                        <a href="{{ route('teacher.classrooms.create') }}"
                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold">
                            Create one
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
