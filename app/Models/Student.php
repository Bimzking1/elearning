<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'nisn', 'date_of_birth', 'gender', 'phone', 'address',
        'class_id', 'guardian_name', 'guardian_phone'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function class() {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
}
