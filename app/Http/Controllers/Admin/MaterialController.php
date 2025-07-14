<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        // Show all classrooms that have at least one material
        $classrooms = Classroom::whereHas('materials')->get();
        return view('admin.materials.index', compact('classrooms'));
    }

    public function byClassroom(Request $request)
    {
        $classroomId = $request->query('classroom_id');

        $classroom = Classroom::findOrFail($classroomId);

        // Get subjects that have materials in this classroom
        $subjects = Subject::whereHas('materials', function ($query) use ($classroomId) {
            $query->where('classroom_id', $classroomId);
        })->get();

        return view('admin.materials.by-classroom', compact('classroom', 'subjects'));
    }

    public function bySubject(Request $request, $subjectId)
    {
        $classroomId = $request->query('classroom_id');
        $subject = Subject::findOrFail($subjectId);
        $classroom = Classroom::findOrFail($classroomId);

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
                        ->withPath(route('admin.materials.bySubject', ['subject' => $subjectId])); // 🔧 fix URL base

        return view('admin.materials.by-subject', compact('subject', 'classroom', 'materials', 'sort', 'direction'));
    }

    public function create(Request $request)
    {
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        $selectedClassroom = $request->query('classroom_id');
        $selectedSubject = $request->query('subject_id');

        return view('admin.materials.create', compact('subjects', 'classrooms', 'selectedClassroom', 'selectedSubject'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:20480', // Max 20MB
            'link_urls' => 'nullable|array',
            'link_urls.*' => 'nullable|url',
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $data['link_urls'] = $request->link_urls ? array_values(array_filter($request->link_urls)) : [];

        Material::create($data);

        return redirect()->route('admin.materials.index')->with('success', 'Material created successfully!');
    }

    public function show($id)
    {
        $material = Material::with(['subject', 'classroom'])->findOrFail($id);
        return view('admin.materials.show', compact('material'));
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        return view('admin.materials.edit', compact('material', 'subjects', 'classrooms'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

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

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Material updated successfully!');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Material deleted successfully!');
    }
}
