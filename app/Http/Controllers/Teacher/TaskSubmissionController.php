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
        $query = TaskSubmission::query()
            ->select('task_submissions.*')
            ->join('students', 'task_submissions.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('tasks', 'task_submissions.task_id', '=', 'tasks.id')
            ->with(['student.user', 'task']) // keep eager loading for blade use
            ->where('task_id', $taskId);

        // Search by student name
        if (request('search')) {
            $query->where('users.name', 'like', '%' . request('search') . '%');
        }

        // Sorting
        $sort = request('sort', 'task_submissions.created_at');
        $direction = request('direction', 'desc');

        // Map sort fields from request to real DB columns
        $sortable = [
            'student_name' => 'users.name',
            'task_title'   => 'tasks.title',
            'created_at'   => 'task_submissions.created_at',
            'score'        => 'task_submissions.score',
        ];

        if (isset($sortable[$sort])) {
            $query->orderBy($sortable[$sort], $direction);
        } else {
            $query->orderBy('task_submissions.created_at', 'desc');
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('teacher.submissions.index', compact('submissions', 'sort', 'direction'));
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
