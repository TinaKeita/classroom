<x-layout :title="'Create User'">

<h1>Create New User</h1>

<form action="{{ route('admin.store') }}" method="POST">
    @csrf
    <p>
        <label>Name:</label><br>
        <input type="text" name="name">
    </p>
    <p>
        <label>Email:</label><br>
        <input type="email" name="email">
    </p>
    <p>
        <label>Password:</label><br>
        <input type="password" name="password">
    </p>
    <p>
        <label>Role:</label><br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student" selected>Student</option>
        </select>
    </p>
    <p>
        <button type="submit">Create User</button>
    </p>
</form>

</x-layout>
