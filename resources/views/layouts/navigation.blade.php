<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <nav class="flex justify-between items-center px-4 py-3">
        <div class="flex items-center gap-6">
            <h1 class="text-lg font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Classroom') }}</h1>
            @auth
                @if(auth()->user()->isTeacher())
                    <a href="{{ route('teacher.classrooms.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Back</a>
                @elseif(auth()->user()->isStudent())
                    <a href="{{ route('student.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Back</a>
                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('admin.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Back</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Profile</a>
            @endauth
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" onclick="toggleTheme()" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.12-2.12a4 4 0 00-5.656 0l-2.12 2.12a1 1 0 101.414 1.414l2.12-2.12a2 2 0 112.828 0l2.121 2.12a1 1 0 101.415-1.414zM2.05 12.464a1 1 0 10-1.414-1.414l-2.12 2.12a4 4 0 005.656 5.656l2.12-2.12a1 1 0 10-1.414-1.414l-2.121 2.121a2 2 0 01-2.828 0l-2.12-2.121z" clip-rule="evenodd"/>
                </svg>
                <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </button>

            @auth
                <p class="text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Izrakstīties</button>
                </form>
            @else
                <p class="text-gray-900 dark:text-white">NOT LOGGED IN</p>
            @endauth
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });

    function toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }
</script>