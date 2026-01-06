<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(Classroom $classroom)
    {
        // pārbaude, ka klase pieder šim skolotājam
        abort_unless($classroom->teacher_id === auth()->id(), 403);

        return view('teacher.assignments.create', compact('classroom'));
    }

    public function store(Request $request, Classroom $classroom)
    {
        abort_unless($classroom->teacher_id === auth()->id(), 403);

        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file'        => ['nullable', 'file', 'max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create([
            'classroom_id' => $classroom->id,
            'title'        => $request->title,
            'description'  => $request->description,
            'file_path'    => $path,
        ]);

        return redirect()->route('teacher.classrooms.show', $classroom);
    }
}
