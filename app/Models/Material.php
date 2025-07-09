<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'subject_id', 'classroom_id', 'description', 'file_path', 'link_urls'
    ];

    protected $casts = [
        'link_urls' => 'array',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }
}
