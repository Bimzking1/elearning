<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function classrooms() {
        return $this->belongsToMany(Classroom::class, 'classroom_subject');
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'teacher_subject');
    }
}
