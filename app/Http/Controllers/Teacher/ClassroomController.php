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
    $classrooms = Classroom::where('teacher_id', auth()->id())->get();

    return view('teacher.classrooms_index', compact('classrooms'));
}

    public function create()
{
    return view('teacher.classrooms_create');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Classroom::create([
            'name'       => $request->name,
            'teacher_id' => auth()->id(),
            'join_code'  => Str::random(6), // piem. 85XYQT
        ]);

        return redirect()->route('teacher.classrooms.index');
    }

    public function show(Classroom $classroom)
{
    abort_unless($classroom->teacher_id === auth()->id(), 403);

    return view('teacher.classrooms_show', compact('classroom'));
}
}
