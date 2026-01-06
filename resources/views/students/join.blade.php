<x-layout title="Join classroom">
    <h1>Join classroom</h1>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first('join_code') }}
        </div>
    @endif

    <form action="{{ route('student.join') }}" method="POST">
        @csrf
        <label>Join code</label>
        <input type="text" name="join_code" maxlength="6">
        <button type="submit">Join</button>
    </form>
</x-layout>
