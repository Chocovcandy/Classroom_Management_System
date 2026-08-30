<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassGroupAnnouncement extends Model
{
    protected $fillable = [
        'class_group_id',
        'user_id',
        'title',
        'content',
    ];

    // ------------------------------------------------------------
    // Class Group
    // An announcement belongs to one class group.
    // ------------------------------------------------------------
    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class, 'class_group_id');
    }

    // ------------------------------------------------------------
    // User
    // The user who created the announcement.
    // ------------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}