<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">Create Classroom</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">New Classroom</h2>

                <form action="{{ route('teacher.classrooms.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Class name
                        </label>
                        <input type="text"
                               name="name"
                               required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700 dark:bg-blue-700 dark:border-blue-600 dark:text-white dark:hover:bg-blue-800">
                        Create
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
