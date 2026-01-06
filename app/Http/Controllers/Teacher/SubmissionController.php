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
        // var papildus pārbaudīt, vai assignment->classroom->teacher_id === auth()->id()
        $submissions = Submission::where('assignment_id', $assignment->id)
            ->with('student') // attiecība Submission->student()
            ->get();

        return view('teacher.submissions.index', compact('assignment', 'submissions'));
    }

    public function updateGrade(Request $request, Submission $submission)
    {
        $request->validate([
            'grade' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        // drošības pēc pārbaude – vai šis submission pieder teacher klasei
        $teacherId = $submission->assignment->classroom->teacher_id ?? null;
        abort_unless($teacherId === auth()->id(), 403);

        $submission->update([
            'grade' => $request->grade,
        ]);

        return back();
    }
}
