<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">My Classrooms</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Join Form -->
                <div class="lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-lg font-semibold mb-4">Join a Classroom</h2>
                        
                        @if ($errors->any())
                            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                                {{ $errors->first('join_code') }}
                            </div>
                        @endif

                        <form action="{{ route('student.join') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Join Code</label>
                                <input type="text" 
                                       name="join_code" 
                                       maxlength="6" 
                                       placeholder="e.g., ABC123"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Ask your teacher for the 6-character code</p>
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-blue-700">
                                Join Classroom
                            </button>
                        </form>
                    </div>
                </div>
                <div class="lg:col-span-2 bg-white shadow rounded p-6">
                    <h2 class="text-lg font-semibold mb-4">My Classrooms</h2>
                    @if(auth()->user()->classrooms()->count())
                        <div class="space-y-2">
                            @foreach(auth()->user()->classrooms as $classroom)
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded">
                                    <div>
                                        <h3 class="font-semibold">{{ $classroom->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $classroom->assignments()->count() }} assignments</p>
                                    </div>
                                    <a href="{{ route('student.classroom.view', $classroom) }}" class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">View</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-6">No classrooms yet. Use the join code above.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
