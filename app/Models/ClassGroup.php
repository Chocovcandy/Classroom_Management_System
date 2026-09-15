<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassGroup extends Model
{
    protected $fillable = [
        'group_name',
        'group_code',
        'professor_id',
        'course_id',
        'description',
        'status',
    ];

    // ============================================================
    // Course
    // ============================================================

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // ============================================================
    // Professor
    // ============================================================

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    // ============================================================
    // Students
    // ============================================================

    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'class_member',
            'class_group_id',
            'user_id'
        )->withTimestamps();
    }

    // ============================================================
    // Announcements
    // One class group has many announcements.
    // ============================================================

    public function announcements()
    {
        return $this->hasMany(
            ClassGroupAnnouncement::class,
            'class_group_id'
        );
    }



    // =====================================================
    // MATERIALS
    // =====================================================

    public function materials()
    {
        return $this->hasMany(
            Material::class,
            'class_group_id'
        );
    }
// =============================================================
// ASSIGNMENTS
// One class group has many assignments.
// =============================================================

public function assignments(): HasMany
{
    return $this->hasMany(Assignment::class);
}


// =============================================================
// QUIZZES
// One class group has many quizzes.
// =============================================================

public function quizzes(): HasMany
{
    return $this->hasMany(Quiz::class);
}


// =============================================================
// EXAMS
// One class group has many exams.
// =============================================================

public function exams(): HasMany
{
    return $this->hasMany(Exam::class);
}


// =============================================================
// TOPICS
// One class group has many topics.
// =============================================================

public function topics(): HasMany
{
    return $this->hasMany(Topic::class)
                ->orderBy('order');
}
public function projects(): HasMany
{
    return $this->hasMany(Project::class, 'class_group_id');
}
}