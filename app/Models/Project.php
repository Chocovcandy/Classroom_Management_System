<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'topic_id',
        'user_id',
        'title',
        'description',
        'due_date',
        'due_time',
        'points',
        'project_type',
    ];

    protected $casts = [
        'due_date' => 'date',
        'points' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Class Group
    |--------------------------------------------------------------------------
    */

    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Professor / User
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Topic
    |--------------------------------------------------------------------------
    */

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Attached Files
    |--------------------------------------------------------------------------
    */

    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

public function groups(): HasMany
{
    return $this->hasMany(ProjectGroup::class);
}

/**
 * Project submissions.
 */
public function submissions(): HasMany
{
    return $this->hasMany(ProjectSubmission::class, 'project_id');
}
}