<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TaskSubmissionController extends Controller
{
    // Display all tasks assigned to the student
    public function index()
    {
        $studentId = Auth::user()->student->id;
        $tasks = Task::whereHas('classroom.students', function($query) use ($studentId) {
            $query->where('students.id', $studentId);
        })->get();

        return view('student.tasks.index', compact('tasks'));
    }

    // Display the task submission form for a particular task
    public function create(Task $task)
    {
        $studentId = Auth::user()->student->id;

        // Check if the student has already submitted the task
        $submission = TaskSubmission::where('task_id', $task->id)
                                    ->where('student_id', $studentId)
                                    ->first();

        if ($submission) {
            return redirect()->route('student.tasks.index')->with('error', 'You have already submitted this task.');
        }

        return view('student.tasks.submit', compact('task'));
    }

    // Store the student submission
    public function store(Request $request, Task $task)
    {
        $studentId = Auth::user()->student->id;

        $request->validate([
            'submission_text' => 'nullable|string|max:5000',
            'submission_file' => 'nullable|file|mimes:pdf,docx,jpg,png',
        ]);

        $submissionFile = null;
        if ($request->hasFile('submission_file')) {
            $submissionFile = $request->file('submission_file')->store('submissions', 'public');
        }

        TaskSubmission::create([
            'task_id' => $task->id,
            'student_id' => $studentId,
            'submission_text' => $request->submission_text,
            'submission_file' => $submissionFile,
            'score' => null, // Score will be updated by the teacher later
        ]);

        return redirect()->route('student.tasks.index')->with('success', 'Task submitted successfully.');
    }

    // View the student's submission for a task
    public function show(Task $task)
    {
        $studentId = Auth::user()->student->id;

        $submission = TaskSubmission::where('task_id', $task->id)
                                    ->where('student_id', $studentId)
                                    ->first();

        if (!$submission) {
            return redirect()->route('student.tasks.index')->with('error', 'You have not submitted this task.');
        }

        return view('student.tasks.show', compact('submission'));
    }

    // Show the edit form
    public function edit(Task $task)
    {
        $studentId = Auth::user()->student->id;

        $submission = TaskSubmission::where('task_id', $task->id)
                                    ->where('student_id', $studentId)
                                    ->firstOrFail();

        return view('student.tasks.edit', compact('task', 'submission'));
    }

    // Handle the update
    public function update(Request $request, Task $task)
    {
        $studentId = Auth::user()->student->id;

        $submission = TaskSubmission::where('task_id', $task->id)
                                    ->where('student_id', $studentId)
                                    ->firstOrFail();

        $request->validate([
            'submission_text' => 'nullable|string|max:5000',
            'submission_file' => 'nullable|file|mimes:pdf,docx,jpg,png',
        ]);

        // Replace the old file if a new one is uploaded
        if ($request->hasFile('submission_file')) {
            if ($submission->submission_file) {
                Storage::disk('public')->delete($submission->submission_file);
            }
            $submission->submission_file = $request->file('submission_file')->store('submissions', 'public');
        }

        $submission->submission_text = $request->submission_text;
        $submission->score = null; // Reset score on re-submission
        $submission->save();

        return redirect()->route('student.tasks.show', $task->id)->with('success', 'Submission updated successfully.');
    }

}
