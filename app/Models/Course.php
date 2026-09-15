<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

protected $fillable = [
    'course_name',
    'course_code',
    'department_id',
    'description',
    'credits',
];
    //student_course pivot table for many-to-many relationship between students and courses
    //One course can have many students, and one student can enroll in many courses.
    public function students()
    {
        return $this->belongsToMany(User::class, 'student_course');
    }
    //schedules of a course
    // One course has many schedules, and one schedule belongs to one course.
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'course_id');
    }

    // department of a course
    // One course belongs to one department, and one department has many courses.
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }


    // Class Groups
    // One course can have many class groups,
    // and one class group belongs to one course.
    public function classGroups()
    {
        return $this->hasMany(ClassGroup::class, 'course_id');
    }

}
