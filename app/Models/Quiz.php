<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Quiz extends Model
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
        'google_form_url',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'due_date' => 'date',
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
    | Topic
    |--------------------------------------------------------------------------
    */

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
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
| Resources
|--------------------------------------------------------------------------
*/

public function resources(): MorphMany
{
    return $this->morphMany(Resource::class, 'resourceable');
}

/*
|--------------------------------------------------------------------------
| Student Submissions
|--------------------------------------------------------------------------
*/

public function submissions(): HasMany
{
    return $this->hasMany(
        QuizSubmission::class,
        'quiz_id'
    );
}
}