<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleDepartment extends Model
{
    protected $table = 'schedule_departments';

    protected $fillable = [
        'schedule_id',
        'department_id',
        'year_level',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}