<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model {
    use HasFactory;

    protected $fillable = [
        'task_id',
        'student_id',
        'submission_text',
        'submission_file',
        'score'
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
