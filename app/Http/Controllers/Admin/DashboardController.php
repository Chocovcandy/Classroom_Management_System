<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | Recent Academic Staff
        |--------------------------------------------------------------------------
        */

        $recentAcademics = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('role_name', [
                    'Dean',
                    'HoD',
                    'Professor',
                ]);
            })
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Departments
        |--------------------------------------------------------------------------
        */

        $recentDepartments = Department::latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Activities
        |--------------------------------------------------------------------------
        */

        $recentActivities = collect();

        foreach ($recentAcademics as $user) {
            $recentActivities->push([
                'type' => 'academic',
                'name' => $user->name,
                'action' => 'created a new account',
                'created_at' => $user->created_at,
                'profile_image' => $user->profile_image,
            ]);
        }

        foreach ($recentDepartments as $department) {
            $recentActivities->push([
                'type' => 'department',
                'name' => $department->department_name,
                'action' => 'department created',
                'created_at' => $department->created_at,
            ]);
        }

        $recentActivities = $recentActivities
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Today's Summary
        |--------------------------------------------------------------------------
        */

        $newUsersToday = User::whereDate(
            'created_at',
            $today
        )->count();

        $newDepartmentsToday = Department::whereDate(
            'created_at',
            $today
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Data
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', [
            'totalUsers' => User::count(),

            'totalStudents' => User::whereHas('roles', function ($query) {
                $query->where('role_name', 'Student');
            })->count(),

            'totalAcademics' => User::whereHas('roles', function ($query) {
                $query->whereIn('role_name', [
                    'Dean',
                    'HoD',
                    'Professor',
                ]);
            })->count(),

            'totalDepartments' => Department::count(),

            'totalRoles' => Role::count(),

            'recentAcademics' => $recentAcademics,

            'recentDepartments' => $recentDepartments,

            'recentActivities' => $recentActivities,

            // Today's Summary
            'newUsersToday' => $newUsersToday,

            'newDepartmentsToday' => $newDepartmentsToday,

            // No Announcement model yet
            'newAnnouncementsToday' => 0,
        ]);
    }
}