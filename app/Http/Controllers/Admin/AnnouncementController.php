<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller {
    public function index() {
        $announcements = Announcement::latest()->get();
        return view('admin.announcement.index', compact('announcements'));
    }

    public function create() {
        return view('admin.announcement.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'roles' => 'required|array',
            'start_date' => 'required|date',  // Make start_date required
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attachment' => 'nullable|file|max:2048', // Max 2MB
        ]);


        // Handle roles logic
        $roles = $request->roles;

        // If "all" is selected, clear other roles
        if (in_array('all', $roles)) {
            $roles = ['all'];
        } else {
            // If "all" is not selected, remove it from the roles array if present
            $roles = array_diff($roles, ['all']);
        }

        // Handle attachment upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('announcements', 'public');
        }

        // Create the announcement
        $announcement = Announcement::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'roles' => $roles,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement) {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'roles' => 'required|array',
            'start_date' => 'required|date',  // Make start_date required
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attachment' => 'nullable|file|max:2048', // Max 2MB
        ]);

        // Find the announcement
        $announcement = Announcement::findOrFail($id);

        // Handle roles logic
        $roles = $request->roles;

        // If "all" is selected, clear other roles
        if (in_array('all', $roles)) {
            $roles = ['all'];
        } else {
            // If "all" is not selected, remove it from the roles array if present
            $roles = array_diff($roles, ['all']);
        }

        // Handle attachment upload (if present)
        $attachmentPath = $announcement->attachment; // Keep existing attachment if no new one is uploaded
        if ($request->hasFile('attachment')) {
            // Delete the old attachment if a new one is uploaded
            if ($attachmentPath) {
                Storage::delete($attachmentPath);
            }
            // Store the new attachment
            $attachmentPath = $request->file('attachment')->store('announcements', 'public');
        }

        // Explicitly handle nullable dates: set to null if empty string is provided
        $start_date = $request->start_date ?: null;
        $end_date = $request->end_date === "" ? null : $request->end_date;

        // Update the announcement
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'roles' => $roles,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement) {
        if ($announcement->attachment) {
            Storage::delete($announcement->attachment);
        }
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
