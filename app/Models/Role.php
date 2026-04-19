<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    // Columns that can be mass-assigned
    protected $fillable = ['role_name'];

    /**
     * Users that belong to this role
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public function getNameAttribute()
{
    return $this->role_name;
}
// when a user registers through register page they MUST automatically become a Student
public function assignStudentRole()
{
    $studentRole = \App\Models\Role::where('role_name', 'Student')->first();

    if (!$studentRole) {
        throw new \Exception('Student role not found');
    }

    if (!$this->roles()->where('role_id', $studentRole->id)->exists()) {
        $this->roles()->attach($studentRole->id);
    }
}


}