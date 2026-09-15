<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'group_name',
        'group_number',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(ProjectGroupMember::class);
    }

    /**
 * Project submissions made by this team.
 */
public function submissions(): HasMany
{
    return $this->hasMany(
        ProjectSubmission::class,
        'project_group_id'
    );
}
}