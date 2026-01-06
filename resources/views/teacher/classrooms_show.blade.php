<x-layout title="Classroom">
@php
    $url = route('student.classroom.join', $classroom->join_code);
@endphp

<p>Join code: {{ $classroom->join_code }}</p>

{!! QrCode::size(200)->generate($url) !!}

</x-layout>