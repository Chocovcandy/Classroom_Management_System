<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'attachment',
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
}