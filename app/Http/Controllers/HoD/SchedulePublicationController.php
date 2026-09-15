<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchedulePublicationController extends Controller
{
    /**
     * Publish the complete weekly schedule.
     */
    public function publish(Schedule $schedule)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as HoD of a department.');
        }

        $belongsToDepartment = $schedule->scheduleDepartments()
            ->where('department_id', $department->id)
            ->exists();

        if (!$belongsToDepartment) {
            abort(403, 'You are not allowed to publish this schedule.');
        }

        $query = Schedule::query()
            ->where('semester', $schedule->semester)
            ->where('academic_year', $schedule->academic_year)
            ->where('promotion', $schedule->promotion)
            ->whereHas('scheduleDepartments', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            });

        if ($schedule->schedule_group_id) {
            $query->where(
                'schedule_group_id',
                $schedule->schedule_group_id
            );
        } else {
            $query->where('id', $schedule->id);
        }

        $updatedCount = $query->update([
            'status' => 'published',
        ]);

        return back()->with(
            'success',
            "{$updatedCount} schedule session(s) published successfully."
        );
    }

    /**
     * Move the complete weekly schedule back to approved.
     */
    public function unpublish(Schedule $schedule)
    {
        /** @var User $user */
        $user = Auth::user();

        $department = $user->departments()
            ->where('head_id', $user->id)
            ->first();

        if (!$department) {
            abort(403, 'You are not assigned as HoD of a department.');
        }

        $belongsToDepartment = $schedule->scheduleDepartments()
            ->where('department_id', $department->id)
            ->exists();

        if (!$belongsToDepartment) {
            abort(403, 'You are not allowed to unpublish this schedule.');
        }

        $query = Schedule::query()
            ->where('semester', $schedule->semester)
            ->where('academic_year', $schedule->academic_year)
            ->where('promotion', $schedule->promotion)
            ->whereHas('scheduleDepartments', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            });

        if ($schedule->schedule_group_id) {
            $query->where(
                'schedule_group_id',
                $schedule->schedule_group_id
            );
        } else {
            $query->where('id', $schedule->id);
        }

        $updatedCount = $query
            ->where('status', 'published')
            ->update([
                'status' => 'approved',
            ]);

        return back()->with(
            'success',
            "{$updatedCount} schedule session(s) moved back to approved."
        );
    }
}