<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'department_name',
        'description',
        'head_id',
    ];

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }

public function users()
{
    return $this->belongsToMany(User::class, 'department_user', 'department_id', 'user_id');
}

    public function departments()
{
    return $this->belongsToMany(Department::class, 'department_user', 'user_id', 'department_id');
}
}
