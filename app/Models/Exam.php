<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'user_id',
        'topic_id',
        'title',
        'description',
        'due_date',
        'due_time',
        'points',
        'google_form_url',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'points' => 'decimal:2',
    ];

    /**
     * Exam belongs to a class group.
     */
    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }

    /**
     * Exam belongs to the professor/user who created it.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Exam optionally belongs to a topic.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Exam resources.
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    /**
     * Student submissions for this exam.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(
            ExamSubmission::class,
            'exam_id'
        );
    }
}