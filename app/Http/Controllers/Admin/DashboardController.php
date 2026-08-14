<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;

class DashboardController extends Controller
{
    // Show dashboard statistics and recent activities
    public function index()
    {
        // Recent academic staff
        $recentAcademics = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('role_name', [
                    'Dean',
                    'HoD',
                    'Professor'
                ]);
            })
            ->latest()
            ->take(5)
            ->get();


        // Recent departments
        $recentDepartments = Department::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | All Recent Activities
        |--------------------------------------------------------------------------
        |
        | Combine academic staff and department records,
        | then sort them together by created_at.
        |
        */

        $recentActivities = collect();


        // Add academic staff activities
        foreach ($recentAcademics as $user) {

            $recentActivities->push([
                'type' => 'academic',
                'name' => $user->name,
                'action' => 'created a new account',
                'created_at' => $user->created_at,
                'profile_image' => $user->profile_image,
            ]);

        }


        // Add department activities
        foreach ($recentDepartments as $department) {

            $recentActivities->push([
                'type' => 'department',
                'name' => $department->department_name,
                'action' => 'department created',
                'created_at' => $department->created_at,
            ]);

        }


        // Sort everything from newest to oldest
        $recentActivities = $recentActivities
            ->sortByDesc('created_at')
            ->take(5)
            ->values();


        return view('admin.dashboard', [

            'totalUsers' => User::count(),

            'totalStudents' => User::whereHas('roles', function ($query) {
                $query->where('role_name', 'Student');
            })->count(),

            'totalAcademics' => User::whereHas('roles', function ($query) {
                $query->whereIn('role_name', [
                    'Dean',
                    'HoD',
                    'Professor'
                ]);
            })->count(),

            'totalDepartments' => Department::count(),

            'totalRoles' => Role::count(),

            'recentAcademics' => $recentAcademics,

            'recentDepartments' => $recentDepartments,

            'recentActivities' => $recentActivities,

        ]);
    }
}