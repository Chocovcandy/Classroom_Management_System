<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectGroupMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_group_id',
        'project_id',
        'user_id',
        'role',
    ];

    public function projectGroup(): BelongsTo
    {
        return $this->belongsTo(ProjectGroup::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Grades received by this team member for project submissions.
     */
    public function submissionGrades(): HasMany
    {
        return $this->hasMany(
            ProjectSubmissionGrade::class,
            'student_id',
            'user_id'
        );
    }
}
