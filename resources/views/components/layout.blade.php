<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Classroom" }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
    @include('layouts.navigation')
    {{ $slot }}
</body>
</html>