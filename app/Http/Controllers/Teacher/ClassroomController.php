<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = auth()->user()->createdClassrooms;
        return view('teacher.classrooms_index', compact('classrooms'));
    }

    public function create()
{
    return view('teacher.classrooms_create');
}

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        
        auth()->user()->createdClassrooms()->create([
            'name' => $validated['name'],
            'join_code' => Str::random(6),
        ]);

        return redirect()->route('teacher.classrooms.index');
    }

    public function show(Classroom $classroom)
    {
        $this->authorize('view', $classroom);
        return view('teacher.classrooms_show', compact('classroom'));
    }
}
