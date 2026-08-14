<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\Course;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',       
        'profile_image', // Add this line to allow mass assignment of profile_image
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
// when a user registers through register page they MUST automatically become a Student
    public function assignStudentRole()
{
    $studentRole = \App\Models\Role::where('role_name', 'Student')->first();

    if (!$studentRole) {
        throw new \Exception('Student role not found in database');
    }

    // Avoid duplicate attach
    if (!$this->roles()->where('role_id', $studentRole->id)->exists()) {
        $this->roles()->attach($studentRole->id);
    }
}

    // Relationships

// one User belongs to one Department.
//why we cant use belongsToMany? 
//because we only have department_id in users table,
// not a pivot table to store the relationship between users and departments, so we can only use belongsTo to get the department of a user. 
//if we have a pivot table (department_user), then we can use belongsToMany to get the departments of a user.
// public function department()
// {
//     return $this->belongsTo(Department::class, 'department_id'); //1 to many , one user belongs to one department, but one department has many users.
   
   
//     //    return $this->belongsToMany(Department::class, 'department_id'); Wrong because belongsToMany is for many to many relationship and
//    // requires: RelatedModel,
//     // pivot_table_name,
//     // foreign_key,
//     // related_key, but we only have department_id in users table, so we can only use belongsTo.

//-> correct one 

public function departments(){
        return $this->belongsToMany(Department::class, 'user_department', 'user_id', 'department_id');
}


    //one  Role has many Users. 
//Use the user_role table to find out which users belong to this role. 
//The column role_id points to this role, and user_id points to the users.
    
public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

        /**
     * ----------------------------------------
     * ROLE CHECK: Is Admin?
     * ----------------------------------------
     * Use this instead of repeating query everywhere in the controller
     */
    public function isAdmin()
    {
        return $this->roles()->where('role_name', 'Admin')->exists();
    }

    public function isStudent()
    {
        return $this->roles()->where('role_name', 'Student')->exists();
    }

    // COURSES (student side)

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course');
    }




    // SCHEDULES (professor side)

    public function teachingSchedules()
    {
        return $this->hasMany(Schedule::class, 'professor_id');
    }
    // for dean to see the schedules hod created and approved

    public function createdSchedules()
    {
        return $this->hasMany(Schedule::class, 'created_by');
    }
//
    public function approvedSchedules()
    {
        return $this->hasMany(Schedule::class, 'approved_by');
    }
}