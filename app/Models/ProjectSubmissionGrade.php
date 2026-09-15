<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSubmissionGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_submission_id',
        'student_id',
        'score',
        'feedback',
        'graded_at',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'graded_at' => 'datetime',
    ];

    /**
     * The project submission this grade belongs to.
     */
    public function projectSubmission(): BelongsTo
    {
        return $this->belongsTo(
            ProjectSubmission::class,
            'project_submission_id'
        );
    }

    /**
     * The student receiving this grade.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }
}