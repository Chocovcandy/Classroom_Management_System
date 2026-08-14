<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'course_id',
        'professor_id',
        'room_id',
        'day_of_week',
        'start_time',
        'end_time',
        'semester',
        'status',
        'created_by',
        'approved_by',
        'note',
    ];

    // Relationships


    // a schedule belongs to a course, and a course has many schedules.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
// professor of the schedule
// One schedule belongs to one professor, and one professor can have many schedules.
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
// classroom of the schedule
// One schedule belongs to one classroom, and one classroom can have many schedules.
    public function room()
    {
        return $this->belongsTo(Classroom::class, 'room_id');
    }
// creator of the schedule
// One schedule belongs to one creator (user), and one user can create many schedules.
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // approver of the schedule
    // One schedule belongs to one approver (user), and one user can approve many schedules

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}