<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class,'user_policy','user_id','policy_id');
    }

    public function assigned_tickets()
    {
        return $this->belongsToMany(Ticket::class,'user_ticket','user_id','ticket_id');
    }

}
