<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Games" }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

 <button id="theme-toggle">Dark / Light</button>

    @auth
        <x-navigation></x-navigation>
    @endauth
    {{ $slot }}

  <script src="{{ asset('theme.js') }}"></script>

</body>
</html>