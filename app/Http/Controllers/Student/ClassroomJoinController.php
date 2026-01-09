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

    public function showClassroom(Classroom $classroom)
    {
        $assignments = $classroom->assignments()->with(['submissions' => function($q) {
            $q->where('student_id', auth()->id());
        }])->get();
        
        return view('students.classroom_view', compact('classroom', 'assignments'));
    }

    public function showJoinForm()
    {
        return view('students.join');
    }

    public function join(Request $request, $join_code = null)
    {
        if (!$join_code) {
            $request->validate(['join_code' => 'required|string|size:6']);
            $join_code = $request->join_code;
        }

        $classroom = Classroom::where('join_code', $join_code)->firstOrFail();
        $request->user()->classrooms()->syncWithoutDetaching([$classroom->id]);

        return redirect()->route('student.assignments.show', $classroom->assignments()->first() ?? $classroom);
    }
}
