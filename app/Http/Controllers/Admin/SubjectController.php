<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show list of subject
    public function index()
    {
        $subject = Subject::all();
        return view('admin.subjects.index', compact('subject'));
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
