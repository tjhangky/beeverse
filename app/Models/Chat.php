<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function firstUser()
    {
        return $this->belongsTo(User::class, 'first_user_id');
    }
    
    public function secondUser()
    {
        return $this->belongsTo(User::class, 'second_user_id');
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class, 'avatar_id');
    }
}
