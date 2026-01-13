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

    public function file(Assignment $assignment)
    {
        // Students can view assignment files if enrolled in classroom
        // Teachers can always view their own assignments
        $user = auth()->user();
        
        if ($user->role === 'teacher') {
            $this->authorize('view', $assignment->classroom);
        } else {
            // Check if student is enrolled in the classroom
            if (!$assignment->classroom->students->contains($user)) {
                abort(403, 'You are not enrolled in this classroom.');
            }
        }

        $path = storage_path('app/public/' . $assignment->file_path);
        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->file($path);
    }
}
