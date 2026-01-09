<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomJoinController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function showJoinForm()
    {
        return view('students.join');
    }

    public function join($join_code = null, Request $request)
    {
        if ($join_code) {
            // Ja join_code ir URL parametrs
            $classroom = Classroom::where('join_code', $join_code)->first();

            if (! $classroom) {
                return back()->withErrors(['join_code' => 'Classroom not found.']);
            }
        } else {
            // Ja join_code ir POST parametrs
            $request->validate([
                'join_code' => ['required', 'string', 'size:6'],
            ]);

            $classroom = Classroom::where('join_code', $request->join_code)->first();

            if (! $classroom) {
                return back()->withErrors(['join_code' => 'Classroom not found.']);
            }
        }

        // pierakstāmies pivot tabulā
        $request->user()->classrooms()->syncWithoutDetaching([$classroom->id]);

        return redirect()->route('student.assignments.show', $classroom->assignments()->first() ?? $classroom);
    }
}
