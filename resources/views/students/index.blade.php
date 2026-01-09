<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Classrooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-600">You're a student. Join classrooms using a join code to get started.</p>
                </div>
            </div>

            <!-- Join Classroom Section -->
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

                <!-- My Classrooms -->
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-lg font-semibold mb-4">My Classrooms</h2>
                        
                        @if(auth()->user()->classrooms()->count())
                            <div class="space-y-3">
                                @foreach(auth()->user()->classrooms as $classroom)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition">
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $classroom->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $classroom->assignments()->count() }} assignments</p>
                                        </div>
                                        <a href="#" class="inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                            View
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-600 mb-4">You haven't joined any classrooms yet.</p>
                                <p class="text-sm text-gray-500">Use the join code from your teacher to get started.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
