<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $teacherId = Auth::user()->teacher->id;
        $tasks = Task::with(['classroom', 'subject'])
                     ->where('teacher_id', $teacherId)
                     ->latest()
                     ->get();

        return view('teacher.task.index', compact('tasks'));
    }

    public function create()
    {
        $teacher = Auth::user()->teacher;

        // Get all classrooms (not just the ones assigned to the teacher)
        $classrooms = Classroom::all();

        // Get the teacher's specialization and use it to determine the subject
        $subject = Subject::where('name', $teacher->specialization)->first();

        return view('teacher.task.create', compact('classrooms', 'subject', 'teacher'));
    }

    public function store(Request $request)
    {
        $teacherId = Auth::user()->teacher->id;

        $request->validate([
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'deadline' => 'required|date',
            'description' => 'nullable|string',
            'attachment_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Get the teacher's specialization to assign subject automatically
        $subject = Subject::where('name', Auth::user()->teacher->specialization)->first();

        $attachmentPath = null;
        if ($request->hasFile('attachment_path')) {
            $attachmentPath = $request->file('attachment_path')->store('attachments', 'public');
        }

        Task::create([
            'title' => $request->title,
            'subject_id' => $subject->id,
            'classroom_id' => $request->classroom_id,
            'deadline' => Carbon::parse($request->deadline),
            'description' => $request->description,
            'teacher_id' => $teacherId,
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->route('teacher.tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $teacher = Auth::user()->teacher;

        if ($task->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.tasks.index')->with('error', 'You are not authorized to edit this task.');
        }

        // Get all classrooms (not just the ones assigned to the teacher)
        $classrooms = Classroom::all();

        // Get the teacher's specialization and use it to determine the subject
        $subject = Subject::where('name', $teacher->specialization)->first();

        return view('teacher.task.edit', compact('task', 'classrooms', 'subject', 'teacher'));
    }

    public function update(Request $request, Task $task)
    {
        $teacher = Auth::user()->teacher;

        if ($task->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.tasks.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'attachment_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Get the teacher's specialization to assign subject automatically
        $subject = Subject::where('name', Auth::user()->teacher->specialization)->first();

        if ($request->hasFile('attachment_path')) {
            if ($task->attachment_path) {
                Storage::delete('public/' . $task->attachment_path);
            }
            $validated['attachment_path'] = $request->file('attachment_path')->store('attachments', 'public');
        }

        $task->update([
            'title' => $validated['title'],
            'subject_id' => $subject->id,
            'classroom_id' => $validated['classroom_id'],
            'deadline' => Carbon::parse($validated['deadline']),
            'description' => $validated['description'],
            'attachment_path' => $validated['attachment_path'] ?? $task->attachment_path,
        ]);

        return redirect()->route('teacher.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->teacher_id !== Auth::user()->teacher->id) {
            return redirect()->route('teacher.tasks.index')->with('error', 'Unauthorized.');
        }

        if ($task->attachment_path) {
            Storage::delete('public/' . $task->attachment_path);
        }

        $task->delete();

        return redirect()->route('teacher.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
