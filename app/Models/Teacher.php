<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'nip', 'date_of_birth', 'gender', 'phone', 'address',
        'specialization', 'joined_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function classrooms() {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }
}
