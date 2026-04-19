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

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_user', 'user_id', 'department_id');
    }

    //one  Role has many Users. 
//Use the user_role table to find out which users belong to this role. 
//The column role_id points to this role, and user_id points to the users.
    
public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }
}
 