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
// one Department has many Users.
public function users()
{
    return $this->hasMany(User::class);
}
// relationship deans and departments (many to many)
public function deans()
{
    return $this->belongsToMany(
        User::class,
        'dean_department',
        'department_id',
        'dean_id'
    );
}

}
