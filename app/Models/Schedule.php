<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'schedule_group_id',

        // Activity information
        'activity_type',
        'special_note',

        'course_id',
        'professor_id',
        'room_id',
        'day_of_week',
        'slot_id',
        'semester',
        'academic_year',
        'promotion',
        'teaching_mode',
        'starting_date',
        'finished_date',
        'midterm_exam_start',
        'midterm_exam_end',
        'final_exam_start',
        'final_exam_end',
        'status',
        'created_by',
        'approved_by',
        'note',
    ];

    // Relationships

    // A schedule belongs to a course, and a course has many schedules.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Professor of the schedule
    // One schedule belongs to one professor, and one professor can have many schedules.
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    // Classroom of the schedule
    // One schedule belongs to one classroom, and one classroom can have many schedules.
    public function room()
    {
        return $this->belongsTo(Classroom::class, 'room_id');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'slot_id');
    }

    // Creator of the schedule
    // One schedule belongs to one creator (user), and one user can create many schedules.
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Approver of the schedule
    // One schedule belongs to one approver, and one user can approve many schedules.
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scheduleDepartments()
    {
        return $this->hasMany(ScheduleDepartment::class);
    }

    public function comments()
    {
        return $this->hasMany(ScheduleComment::class);
    }
}