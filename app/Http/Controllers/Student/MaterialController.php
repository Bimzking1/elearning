<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function bySubject(Request $request, $subjectId)
    {
        $student = Auth::user()->student;

        $subject = \App\Models\Subject::findOrFail($subjectId);

        $query = Material::where('subject_id', $subjectId)
            ->where('classroom_id', $student->classroom_id);

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sortable = ['name', 'created_at'];
        $sort = in_array($request->get('sort'), $sortable) ? $request->get('sort') : 'created_at';
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        $materials = $query->orderBy($sort, $direction)
            ->paginate(20)
            ->appends([
                'search' => $request->search,
                'sort' => $sort,
                'direction' => $direction
            ]);

        return view('student.materials.by-subject', compact('subject', 'materials', 'sort', 'direction'));
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
