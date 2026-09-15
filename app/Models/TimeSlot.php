<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slots';

    protected $fillable = [
        'session_number',
        'session_label',
        'start_time',
        'end_time',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'slot_id');
    }
}