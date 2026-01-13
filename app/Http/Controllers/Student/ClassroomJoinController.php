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
        // Check if student is in this classroom
        if (!auth()->user()->classrooms->contains($classroom)) {
            abort(403, 'You are not enrolled in this classroom');
        }

        // Get all assignments for this classroom with the current student's submissions
        $assignments = $classroom->assignments()
            ->with(['submissions' => function($query) {
                $query->where('student_id', auth()->id());
            }])
            ->orderByDesc('created_at')
            ->get();
        
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

        return redirect()->route('student.classroom.view', $classroom);
    }
}
