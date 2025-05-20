<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'content', 'roles', 'start_date', 'end_date', 'attachment'
    ];

    protected $casts = [
        'roles' => 'array', // Automatically convert JSON to array
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool {
        $now = Carbon::now();
        return (!$this->start_date || $this->start_date <= $now) &&
               (!$this->end_date || $this->end_date >= $now);
    }
}
