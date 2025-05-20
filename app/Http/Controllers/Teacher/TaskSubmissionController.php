<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use App\Models\Task;

class TaskSubmissionController extends Controller
{
    // Show list of all task submissions (optional: filter by teacher's tasks)
    public function index($taskId)
    {
        // Only get submissions for the specific task
        $submissions = TaskSubmission::with(['task', 'student.user'])
                        ->where('task_id', $taskId)
                        ->get();

        return view('teacher.submissions.index', compact('submissions'));
    }

    // Show form to grade a submission

    public function edit($taskId, $submissionId)
    {
        // Fetch the task submission by ID
        $submission = TaskSubmission::findOrFail($submissionId);

        // Debug the fetched submission
        // dd($submission);

        // Pass the submission to the view
        return view('teacher.submissions.edit', compact('submission'));
    }

    // Store score and comments
    // public function update(Request $request, TaskSubmission $submission)
    public function update(Request $request, Task $task, TaskSubmission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'comments' => 'nullable|string|max:1000',
        ]);

        // Update the submission with the provided score and comments
        $submission->update([
            'score' => $request->score,
            'comments' => $request->comments,
        ]);

        // Redirect with success message
        return redirect()->route('teacher.tasks.submissions.index', ['task' => $submission->task_id])
                         ->with('success', 'Submission graded successfully.');
    }
}
