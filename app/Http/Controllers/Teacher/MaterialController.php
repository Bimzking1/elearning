<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        $classrooms = Classroom::whereHas('materials.subject', function ($query) use ($specializations) {
            $query->whereIn('name', $specializations);
        })->get();

        return view('teacher.materials.index', compact('classrooms'));
    }

    public function byClassroom(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $classroomId = $request->query('classroom_id');
        $classroom = Classroom::findOrFail($classroomId);

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        $materials = Material::where('classroom_id', $classroomId)
            ->whereHas('subject', function ($query) use ($specializations) {
                $query->whereIn('name', $specializations);
            })
            ->with('subject')
            ->get();

        return view('teacher.materials.list', [
            'materials' => $materials,
            'classroom' => $classroom,
            'teacher' => $teacher,
        ]);
    }

    public function bySubject(Request $request, $subjectId)
    {
        $teacher = Auth::user()->teacher;

        $classroomId = $request->query('classroom_id');
        $classroom = Classroom::findOrFail($classroomId);
        $subject = Subject::findOrFail($subjectId);

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        if (!in_array($subject->name, $specializations)) {
            abort(403, 'You are not allowed to view this subject.');
        }

        $query = Material::where('subject_id', $subjectId)
            ->where('classroom_id', $classroomId);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sortableColumns = ['name', 'created_at'];
        $sort = in_array($request->get('sort'), $sortableColumns) ? $request->get('sort') : 'created_at';
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        $materials = $query->orderBy($sort, $direction)
            ->paginate(20)
            ->appends([
                'search' => $request->search,
                'view' => $request->view,
                'sort' => $sort,
                'direction' => $direction,
                'classroom_id' => $classroomId,
            ])
            ->withPath(route('teacher.materials.bySubject', ['subject' => $subjectId])); // 🔧 fix URL base

        return view('teacher.materials.by-subject', compact('subject', 'classroom', 'materials', 'sort', 'direction'));
    }

    public function create()
    {
        $teacher = Auth::user()->teacher;

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        $subjects = Subject::whereIn('name', $specializations)->get();
        $classrooms = Classroom::all();

        return view('teacher.materials.create', compact('subjects', 'classrooms'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
            'link_urls' => 'nullable|array',
            'link_urls.*' => 'nullable|url',
        ]);

        $subject = Subject::findOrFail($data['subject_id']);
        $classroom = Classroom::findOrFail($data['classroom_id']);

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        if (!in_array($subject->name, $specializations)) {
            abort(403, 'You are not allowed to create materials for this subject.');
        }

        // if ($classroom->teacher_id !== $teacher->id) {
        //     abort(403, 'You are not assigned to this classroom.');
        // }

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $data['link_urls'] = array_values(array_filter($request->link_urls ?? []));

        Material::create($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Material created successfully!');
    }

    public function show(Material $material)
    {
        $this->authorizeView($material);

        $subject = $material->subject;
        $classroom = $material->classroom;

        return view('teacher.materials.show', compact('material', 'subject', 'classroom'));
    }

    public function edit(Material $material)
    {
        $this->authorizeView($material);

        $teacher = Auth::user()->teacher;

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        $subject = $material->subject;
        $classroom = $material->classroom;

        $subjects = Subject::whereIn('name', $specializations)->get();
        $classrooms = Classroom::whereHas('materials.subject', function ($query) use ($specializations) {
            $query->whereIn('name', $specializations);
        })->get();

        return view('teacher.materials.edit', compact('material', 'subjects', 'classrooms', 'subject', 'classroom'));
    }

    public function update(Request $request, Material $material)
    {
        $this->authorizeView($material);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
            'link_urls' => 'nullable|array',
            'link_urls.*' => 'nullable|url',
        ]);

        if ($request->hasFile('file')) {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $data['link_urls'] = array_filter($request->link_urls ?? []);

        $material->update($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Material updated successfully!');
    }

    public function destroy(Material $material)
    {
        $this->authorizeView($material);

        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('teacher.materials.index')->with('success', 'Material deleted successfully!');
    }

    private function authorizeView(Material $material)
    {
        $teacher = Auth::user()->teacher;

        $specializations = is_array($teacher->specialization)
            ? array_map('trim', $teacher->specialization)
            : array_map('trim', explode(',', $teacher->specialization));

        if (!in_array($material->subject->name, $specializations)) {
            abort(403, 'You are not allowed to access this material.');
        }
    }
}
