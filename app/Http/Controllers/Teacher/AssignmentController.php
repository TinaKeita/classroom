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
        $this->authorize('view', $classroom);
        return view('teacher.assignments.create', compact('classroom'));
    }

    public function store(Request $request, Classroom $classroom)
    {
        $this->authorize('view', $classroom);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $validated['classroom_id'] = $classroom->id;
        $validated['file_path'] = $request->file('file')?->store('assignments', 'public');
        
        Assignment::create($validated);
        return redirect()->route('teacher.classrooms.show', $classroom);
    }
}
