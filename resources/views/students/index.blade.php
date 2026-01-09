<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">My Classrooms</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded p-6">
                    <h2 class="text-lg font-semibold mb-4">Join Classroom</h2>
                    @if ($errors->any())
                        <div class="mb-4 p-2 bg-red-100 text-red-700 rounded text-sm">{{ $errors->first('join_code') }}</div>
                    @endif
                    <form action="{{ route('student.join') }}" method="POST">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Join Code</label>
                        <input type="text" name="join_code" maxlength="6" placeholder="ABC123" class="w-full px-3 py-2 border border-gray-300 rounded mb-3" required />
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Join</button>
                    </form>
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
                                    <a href="#" class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">View</a>
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
