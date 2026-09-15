<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProjectSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'student_id',
        'project_group_id',
        'submitted_at',
        'score',
        'feedback',
        'graded_at',
        'status',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'score' => 'decimal:2',
        'graded_at' => 'datetime',
    ];

    /**
     * The project this submission belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * The student who submitted the project.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * The team this submission belongs to.
     *
     * NULL for Individual Projects.
     */
    public function projectGroup(): BelongsTo
    {
        return $this->belongsTo(ProjectGroup::class);
    }

    /**
     * Files submitted with the project.
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    /**
     * Individual grades for members of a team submission.
     */
    public function grades(): HasMany
    {
        return $this->hasMany(ProjectSubmissionGrade::class);
    }
}