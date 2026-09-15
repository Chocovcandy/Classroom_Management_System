<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Material extends Model
{
    protected $fillable = [
        'class_group_id',
        'user_id',
        'topic_id',
        'title',
        'description',
        // 'created_at',
        // 'updated_at', // dont need it cuz timestamps() will automatically handle it
    ];

    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic(): BelongsTo
{
    return $this->belongsTo(Topic::class);
}

// morphMany() : polymorphic one-to-many relationship
//morphMany() means: one model can have many related records, and those records can belong to different model types.
// For eg : A Material can have many resources (pdf,pptx,video,mp3,execl...), and those resources can belong to different model types (like Assignment, Exam, Quiz, etc.).

public function resources(): MorphMany
{
    return $this->morphMany(Resource::class, 'resourceable');
}


}