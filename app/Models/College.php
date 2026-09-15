<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = [
        'college_name',
        'description',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}