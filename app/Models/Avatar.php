<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    public function userAvatars() {
        return $this->hasMany(UserAvatar::class);
    }
    
    public function chats() {
        return $this->hasMany(Chat::class);
    }
}
