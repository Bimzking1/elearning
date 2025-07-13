<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show list of subject
    public function index(Request $request)
    {
        $query = Subject::query();

        // 🔍 Search by subject name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔃 Sorting
        $allowedSorts = ['name', 'description'];
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        }

        $subjects = $query->paginate(20)->withQueryString();

        return view('admin.subjects.index', compact('subjects', 'sort', 'direction'));
    }

    // Show form to create new subject
    public function create()
    {
        return view('admin.subjects.create');
    }

    // Store new subject
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Subject::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    // Show form to edit existing subject
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    // Update existing subject
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $subject->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    // Delete subject
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
