<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Avatar::create([
            // 'name' => 'Avatar 1',
            'image' => 'avatars/avatar_1.jpg',
            'price' => rand(50, 100000),

        ]);
        Avatar::create([
            // 'name' => 'Avatar 2',
            'image' => 'avatars/avatar_2.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 3',
            'image' => 'avatars/avatar_3.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 4',
            'image' => 'avatars/avatar_4.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 5',
            'image' => 'avatars/avatar_5.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 6',
            'image' => 'avatars/avatar_6.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 7',
            'image' => 'avatars/avatar_7.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 8',
            'image' => 'avatars/avatar_8.jpg',
            'price' => rand(50, 100000),
        ]);
        Avatar::create([
            // 'name' => 'Avatar 9',
            'image' => 'avatars/avatar_9.jpg',
            'price' => rand(50, 100000),
        ]);
        
    }
}
