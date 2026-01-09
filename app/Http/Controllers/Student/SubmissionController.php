<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function create(Assignment $assignment)
    {
        return view('students.assignment_submit', compact('assignment'));
    }

    public function store(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:4096',
            'comment' => 'nullable|string',
        ]);

        $validated['assignment_id'] = $assignment->id;
        $validated['student_id'] = auth()->id();
        $validated['file_path'] = $request->file('file')->store('submissions', 'public');

        Submission::create($validated);
        return back()->with('success', 'Assignment submitted.');
    }
}
