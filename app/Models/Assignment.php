<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
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
    'attachment',
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
}