<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'department_name',
        'description',
        'head_id',
    ];
// head of the department
// One department has one head (professor), and one professor can be the head of one department.
    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }
// one Department has many Users.

public function users()
{
    return $this->belongsToMany(User::class, 'department_user');
}
// one Department has many Courses, and one Course belongs to one Department.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


}
