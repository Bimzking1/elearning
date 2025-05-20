<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['classroom', 'subject', 'teacher'])->latest()->get();
        return view('admin.task.index', compact('tasks'));
    }

    public function create()
    {
        $classrooms = Classroom::all();

        if (auth()->user()->role === 'admin') {
            $subjects = Subject::all();
            $teachers = Teacher::with('user')->get();
        } else {
            // For teacher
            $teacher = Teacher::where('user_id', auth()->id())->first();
            $subjects = Subject::where('name', $teacher->specialization)->get(); // Assumes subject.name == teacher.specialization
            $teachers = null; // Not needed for teachers
        }

        return view('admin.task.create', compact('classrooms', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $isAdmin = auth()->user()->role === 'admin';

        $rules = [
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'deadline' => 'required|date',
            'description' => 'nullable|string',
            'attachment_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ];

        if ($isAdmin) {
            $rules['subject_id'] = 'required|exists:subjects,id';
            $rules['teacher_id'] = 'required|exists:teachers,id';
        }

        $request->validate($rules);

        $attachmentPath = null;
        if ($request->hasFile('attachment_path')) {
            $attachmentPath = $request->file('attachment_path')->store('attachments', 'public');
        }

        $task = new Task();
        $task->title = $request->title;
        $task->classroom_id = $request->classroom_id;
        $task->description = $request->description;
        $task->deadline = Carbon::parse($request->deadline);
        $task->attachment_path = $attachmentPath;

        if ($isAdmin) {
            $task->subject_id = $request->subject_id;
            $task->teacher_id = $request->teacher_id;
        } else {
            $teacher = Teacher::where('user_id', auth()->id())->first();
            $subject = Subject::where('name', $teacher->specialization)->first();

            $task->teacher_id = $teacher->id;
            $task->subject_id = $subject->id ?? null;
        }

        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';

        if (!$isAdmin) {
            $teacher = Teacher::where('user_id', $user->id)->first();
            if ($task->teacher_id !== $teacher->id) {
                return redirect()->route('admin.tasks.index')->with('error', 'You cannot edit this task.');
            }
        }

        $classrooms = Classroom::all();

        if ($isAdmin) {
            $subjects = Subject::all();
            $teachers = Teacher::with('user')->get();
        } else {
            $teacher = Teacher::where('user_id', auth()->id())->first();
            $subjects = Subject::where('name', $teacher->specialization)->get();
            $teachers = null; // not used
        }

        return view('admin.task.edit', compact('task', 'classrooms', 'subjects', 'teachers'));
    }

    public function update(Request $request, Task $task)
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';

        if (!$isAdmin) {
            $teacher = Teacher::where('user_id', $user->id)->first();
            if ($task->teacher_id !== $teacher->id) {
                return redirect()->route('admin.tasks.index')->with('error', 'You cannot edit this task.');
            }
        }

        $rules = [
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'attachment_path' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png',
        ];

        if ($isAdmin) {
            $rules['subject_id'] = 'required|exists:subjects,id';
            $rules['teacher_id'] = 'required|exists:teachers,id';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('attachment_path')) {
            if ($task->attachment_path) {
                Storage::delete('public/' . $task->attachment_path);
            }
            $validated['attachment_path'] = $request->file('attachment_path')->store('task_attachments', 'public');
        }

        if (!$isAdmin) {
            $teacher = Teacher::where('user_id', $user->id)->first();
            $subject = Subject::where('name', $teacher->specialization)->first();
            $validated['teacher_id'] = $teacher->id;
            $validated['subject_id'] = $subject->id ?? null;
        }

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->attachment_path) {
            Storage::delete('public/' . $task->attachment_path);
        }

        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
