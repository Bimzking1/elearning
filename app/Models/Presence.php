<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'schedule_id', 'opened_at', 'reopened_at', 'closed_at'];

    protected $casts = [
        'opened_at' => 'datetime',
        'reopened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function submissions()
    {
        return $this->hasMany(PresenceSubmission::class);
    }

    public function isOpen()
    {
        return is_null($this->closed_at) &&
               now()->diffInMinutes($this->reopened_at ?? $this->opened_at) < 120;
    }
}
