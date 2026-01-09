<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Submissions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Student Submissions</h2>

                <div class="space-y-4">
                    @foreach($submissions as $submission)
                        <div class="border border-gray-200 rounded p-4">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-semibold">
                                    {{ $submission->student->name }}
                                </p>
                                <a href="{{ route('teacher.submissions.file', $submission) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                    View file
                                </a>
                            </div>

                            <form action="{{ route('teacher.submissions.grade', $submission) }}"
                                  method="POST"
                                  class="flex items-center space-x-3 mt-2">
                                @csrf
                                @method('PUT')

                                <input type="number"
                                       name="grade"
                                       value="{{ $submission->grade }}"
                                       min="1"
                                       max="10"
                                       class="w-20 px-2 py-1 border border-gray-300 rounded">

                                <button type="submit"
                                        class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                                    Save grade
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
