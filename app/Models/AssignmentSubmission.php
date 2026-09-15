<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AssignmentSubmission extends Model
{
    use HasFactory;

protected $fillable = [
    'assignment_id',
    'student_id',
    'submitted_at',
    'score',
    'feedback',
    'graded_at',
];

protected $casts = [
    'submitted_at' => 'datetime',
    'score' => 'decimal:2',
    'graded_at' => 'datetime',
];

    /**
     * The assignment this submission belongs to.
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * The student who made the submission.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Files submitted by the student.
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    // student can submit multiple files for an assignment submission
    public function submissions()
{
    return $this->hasMany(AssignmentSubmission::class);
}
}