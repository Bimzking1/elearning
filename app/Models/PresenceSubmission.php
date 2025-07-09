<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PresenceSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['presence_id', 'student_id', 'photo_path'];

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
