<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'nis', 'date_of_birth', 'gender', 'phone', 'address',
        'classroom_id', 'guardian_name', 'guardian_phone'
    ];

    protected $with = ['user', 'classroom'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
