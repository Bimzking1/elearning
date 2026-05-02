<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'is_pinned',
        'pin_order',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'pin_order' => 'integer',
    ];

    /**
     * Scope: only pinned images, newest pin first (highest pin_order desc).
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true)->orderByDesc('pin_order');
    }
}
