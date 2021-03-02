<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function assigned_users()
    {
        return $this->belongsToMany(User::class,'user_ticket','ticket_id','user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
