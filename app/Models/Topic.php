<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = [
        'class_group_id',
        'topic_name',
        'description',
        'order',
    ];

    /**
     * Topic belongs to a class group.
     */
    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }

    /**
     * Topic has many materials.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Topic has many assignments.
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    /**
     * Topic has many quizzes.
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Topic has many exams.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
