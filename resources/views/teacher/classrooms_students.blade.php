<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">{{ $classroom->name }} - Students</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold dark:text-white">Students in {{ $classroom->name }}</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Total: {{ $students->count() }} student(s)</p>
                    </div>
                    <a href="{{ route('teacher.classrooms.show', $classroom) }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                        Back to Classroom
                    </a>
                </div>

                @if($students->count())
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="w-1/2 px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">Name</th>
                                    <th class="w-1/2 px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="w-1/2 px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $student->name }}</td>
                                        <td class="w-1/2 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $student->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 dark:text-gray-300 text-lg">No students in this classroom yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
