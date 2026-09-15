<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Resource extends Model
{
    protected $fillable = [
        'resourceable_type',
        'resourceable_id',
        'title',
        'type',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'url',
    ];

    /**
     * Get the model that owns this resource.
     */
    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }
}