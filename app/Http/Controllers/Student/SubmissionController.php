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
        $request->validate([
            'file'    => ['required', 'file', 'max:4096'],
            'comment' => ['nullable', 'string'],
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id'    => $request->user()->id,
            'file_path'     => $path,
            'comment'       => $request->comment,
        ]);

        return back()->with('success', 'Assignment submitted.');
    }
}
