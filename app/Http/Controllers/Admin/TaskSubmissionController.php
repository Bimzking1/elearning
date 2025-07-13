<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use App\Models\Task;

class TaskSubmissionController extends Controller
{
    // Show list of all task submissions (optional: filter by admin's tasks)
    public function index(Request $request, $taskId)
    {
        $query = TaskSubmission::with(['task', 'student.user'])
            ->where('task_id', $taskId);

        // Search
        if ($request->filled('search')) {
            $query->whereHas('student.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $allowedSorts = ['student_name', 'task_title', 'created_at', 'score'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        if (in_array($sort, $allowedSorts)) {
            if ($sort === 'student_name') {
                $query->join('students', 'task_submissions.student_id', '=', 'students.id')
                    ->join('users', 'students.user_id', '=', 'users.id')
                    ->orderBy('users.name', $direction)
                    ->select('task_submissions.*');
            } elseif ($sort === 'task_title') {
                $query->join('tasks', 'task_submissions.task_id', '=', 'tasks.id')
                    ->orderBy('tasks.title', $direction)
                    ->select('task_submissions.*');
            } else {
                $query->orderBy($sort, $direction);
            }
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions.index', compact('submissions', 'sort', 'direction'));
    }

    // Show form to grade a submission

    public function edit($taskId, $submissionId)
    {
        // Fetch the task submission by ID
        $submission = TaskSubmission::findOrFail($submissionId);

        // Debug the fetched submission
        // dd($submission);

        // Pass the submission to the view
        return view('admin.submissions.edit', compact('submission'));
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
        return redirect()->route('admin.tasks.submissions.index', ['task' => $submission->task_id])
                         ->with('success', 'Submission graded successfully.');
    }
}
