<?php

namespace Database\Seeders;

use App\Models\UserAvatar;
use Illuminate\Database\Seeder;

class UserAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAvatar::create([
            'user_id' => 2,
            'avatar_id' => 5,
        ]);
        UserAvatar::create([
            'user_id' => 2,
            'avatar_id' => 6,
        ]);
        UserAvatar::create([
            'user_id' => 2,
            'avatar_id' => 7,
        ]);
    }
}
