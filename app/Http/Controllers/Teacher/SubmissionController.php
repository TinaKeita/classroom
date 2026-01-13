<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Assignment;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Assignment $assignment)
    {
        $this->authorize('view', $assignment->classroom);
        $submissions = $assignment->submissions()->with('student')->get();
        return view('teacher.submissions.index', compact('assignment', 'submissions'));
    }

    public function updateGrade(Request $request, Submission $submission)
    {
        $this->authorize('view', $submission->assignment->classroom);
        
        $validated = $request->validate([
            'grade' => 'nullable|integer|min:0|max:10',
            'teacher_comment' => 'nullable|string',
        ]);
        
        $submission->update($validated);
        
        return back()->with('success', 'Grade and feedback saved!');
    }

    public function file(Submission $submission)
    {
        $this->authorize('view', $submission->assignment->classroom);

        $path = storage_path('app/public/' . $submission->file_path);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
