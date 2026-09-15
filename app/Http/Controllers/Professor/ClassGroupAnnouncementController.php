<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\ClassGroupAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClassGroupAnnouncementController extends Controller
{
    /**
     * Store a new announcement.
     */
    public function store(
        Request $request,
        ClassGroup $classGroup
    ) {
        Gate::authorize('manage', $classGroup);

        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $classGroup->announcements()->create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Announcement posted successfully.'
            );
    }

    /**
     * Show edit announcement form.
     */
    public function edit(
        ClassGroup $classGroup,
        ClassGroupAnnouncement $announcement
    ) {
        Gate::authorize('manage', $classGroup);

        if ($announcement->class_group_id !== $classGroup->id) {
            abort(404);
        }

        return view(
            'professor.class_groups.classroom_group.announcements.edit',
            compact(
                'classGroup',
                'announcement'
            )
        );
    }

    /**
     * Update an announcement.
     */
    public function update(
        Request $request,
        ClassGroup $classGroup,
        ClassGroupAnnouncement $announcement
    ) {
        Gate::authorize('manage', $classGroup);

        if ($announcement->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Announcement updated successfully.'
            );
    }

    /**
     * Delete an announcement.
     */
    public function destroy(
        ClassGroup $classGroup,
        ClassGroupAnnouncement $announcement
    ) {
        Gate::authorize('manage', $classGroup);

        if ($announcement->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $announcement->delete();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Announcement deleted successfully.'
            );
    }
}