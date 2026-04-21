<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Department;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'status'
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
public function department()
{
    return $this->belongsTo(Department::class, 'department_id'); //1 to many , one user belongs to one department, but one department has many users.
   
   
    //    return $this->belongsToMany(Department::class, 'department_id'); Wrong because belongsToMany is for many to many relationship and
   // requires: RelatedModel,
    // pivot_table_name,
    // foreign_key,
    // related_key, but we only have department_id in users table, so we can only use belongsTo.
}

    //one  Role has many Users. 
//Use the user_role table to find out which users belong to this role. 
//The column role_id points to this role, and user_id points to the users.
    
public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }


    // relationship deans and departments (many to many)
// A user can be a dean of multiple departments
//after setting the pivot table dean_department, we can use belongsToMany 
//but why dean still  cant have more than one department? when we test it ?
// department_id in users table is use belongsTo relationship, since it cant be use belongsToMany, 
public function deanDepartments()
{
    return $this->belongsToMany(Department::class, 'dean_department', 'dean_id', 'department_id');      
}
 
}