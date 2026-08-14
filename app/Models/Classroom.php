<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = [
        'room_number',
        'capacity',
        'building',
    ];

    // schedules of a classroom
    // One classroom has many schedules, and one schedule belongs to one classroom.
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'classroom_id');
    }
}
