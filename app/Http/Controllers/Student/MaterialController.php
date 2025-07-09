<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $classroomId = $student->classroom_id;

        $subjects = Material::where('classroom_id', $classroomId)
            ->with('subject')
            ->get()
            ->pluck('subject')
            ->unique('id');

        return view('student.materials.index', compact('subjects'));
    }

    public function bySubject($subjectId)
    {
        $student = Auth::user()->student;

        $subject = \App\Models\Subject::findOrFail($subjectId);

        $materials = Material::where('subject_id', $subjectId)
            ->where('classroom_id', $student->classroom_id)
            ->get();

        return view('student.materials.by-subject', compact('subject', 'materials'));
    }

    public function show($id)
    {
        $student = Auth::user()->student;

        $material = Material::where('id', $id)
            ->where('classroom_id', $student->classroom_id)
            ->with(['subject', 'classroom'])
            ->firstOrFail();

        $subject = $material->subject;
        $classroom = $material->classroom;

        return view('student.materials.show', compact('material', 'subject', 'classroom'));
    }
}
