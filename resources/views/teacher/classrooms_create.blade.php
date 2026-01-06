<x-layout title="Create classroom">
<form action="{{ route('teacher.classrooms.store') }}" method="POST">
    @csrf
    <label>Class name</label>
    <input type="text" name="name">
    <button type="submit">Create</button>
</form>
</x-layout>