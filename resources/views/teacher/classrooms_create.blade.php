<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Classroom</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">New Classroom</h2>

                <form action="{{ route('teacher.classrooms.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Class name
                        </label>
                        <input type="text"
                               name="name"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700">
                        Create
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
