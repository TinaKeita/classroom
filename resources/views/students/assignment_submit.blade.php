<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">{{ $assignment->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold dark:text-white mb-2">{{ $assignment->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ $assignment->description }}</p>
                </div>

                @if($assignment->file_path)
                    <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
                        <p class="text-sm text-blue-800 dark:text-blue-300 mb-3 font-semibold">📎 Assignment File</p>
                        <a href="{{ asset('storage/' . $assignment->file_path) }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-medium">
                            Download File
                        </a>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-800 font-semibold">✓ {{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('student.assignments.submit', $assignment) }}"
                      method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Upload File <span class="text-red-600">*</span>
                        </label>
                        <input type="file" 
                               id="file"
                               name="file" 
                               required
                               class="block w-full text-sm text-gray-500 dark:text-gray-400
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100
                                   dark:file:bg-blue-900 dark:file:text-blue-300">
                    </div>

                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Comment (optional)
                        </label>
                        <textarea id="comment"
                                  name="comment"
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Submit Assignment
                        </button>
                        <a href="{{ route('student.classroom.view', $assignment->classroom) }}" class="inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Classroom
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
