<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isTeacher())
                        <div>
                            <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>
                            <p class="text-gray-600 mb-6">You are logged in as a teacher.</p>
                            <a href="{{ route('teacher.classrooms.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                View My Classrooms
                            </a>
                        </div>
                    @elseif(auth()->user()->isStudent())
                        <div>
                            <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>
                            <p class="text-gray-600 mb-6">You are logged in as a student.</p>
                            <a href="{{ route('student.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Go to My Classrooms
                            </a>
                        </div>
                    @elseif(auth()->user()->isAdmin())
                        <div>
                            <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>
                            <p class="text-gray-600 mb-6">You are logged in as an admin.</p>
                            <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Admin Panel
                            </a>
                        </div>
                    @else
                        <p>{{ __("You're logged in!") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
