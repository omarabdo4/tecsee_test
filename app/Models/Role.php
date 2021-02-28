<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany(User::class,'role_id');
    }

    /**
     * The policies that belong to the role.
     */
    public function policies()
    {
        return $this->belongsToMany(Policy::class,'role_policy','role_id','policy_id');
    }
}
