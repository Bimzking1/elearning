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
    public function index(Request $request)
    {
        $query = Task::query()
            ->leftJoin('subjects', 'tasks.subject_id', '=', 'subjects.id')
            ->leftJoin('classrooms', 'tasks.classroom_id', '=', 'classrooms.id')
            ->leftJoin('teachers', 'tasks.teacher_id', '=', 'teachers.id')
            ->select('tasks.*', 'subjects.name as subject_name', 'classrooms.name as classroom_name')
            ->with(['subject', 'classroom', 'teacher']);

        // 🔍 Search by task title
        if ($request->filled('search')) {
            $query->where('tasks.title', 'like', '%' . $request->search . '%');
        }

        // 🔃 Sorting logic
        $allowedSorts = ['title', 'deadline', 'subject_name', 'classroom_name'];
        $sort = $request->get('sort', 'deadline');
        $direction = $request->get('direction', 'desc');

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        }

        $tasks = $query->paginate(20)->withQueryString();

        return view('admin.task.index', compact('tasks', 'sort', 'direction'));
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
            'classroom_id' => 'required|array', // ✅ Accept multiple classrooms
            'classroom_id.*' => 'exists:classrooms,id',
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

        $teacherId = null;
        $subjectId = null;

        if ($isAdmin) {
            $teacherId = $request->teacher_id;
            $subjectId = $request->subject_id;
        } else {
            $teacher = Teacher::where('user_id', auth()->id())->first();
            $subject = Subject::where('name', $teacher->specialization)->first();
            $teacherId = $teacher->id;
            $subjectId = $subject->id ?? null;
        }

        foreach ($request->classroom_id as $classroomId) {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => Carbon::parse($request->deadline),
                'attachment_path' => $attachmentPath,
                'classroom_id' => $classroomId,
                'teacher_id' => $teacherId,
                'subject_id' => $subjectId,
            ]);
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created for selected classrooms.');
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
