<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Your table is probably singular "Role"
    protected $table = 'Role';

    // Columns that can be mass-assigned
    protected $fillable = ['role_name'];

    /**
     * Users that belong to this role
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
}