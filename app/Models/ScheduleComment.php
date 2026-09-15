<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleComment extends Model
{
    protected $table = 'schedule_comments';

    protected $fillable = [
        'schedule_id',
        'user_id',
        'slot_id',
        'day_of_week',
        'content',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'slot_id');
    }
}