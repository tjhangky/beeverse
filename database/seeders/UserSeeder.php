<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'gender' => 'male',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_1.jpg',
            'balance' => 1000000,
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            // hobbies
        ]);

        User::create([
            'name' => 'user2',
            'gender' => 'female',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user2',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_2.jpg',
            'balance' => 1000000,
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user3',
            'gender' => 'male',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user3',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_3.jpg',
            'balance' => 100,
            'email' => 'user3@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user4',
            'gender' => 'female',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user4',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_4.jpg',
            'balance' => 1000000,
            'email' => 'user4@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user5',
            'gender' => 'female',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user5',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_5.jpg',
            'balance' => 1000000,
            'email' => 'user5@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user6',
            'gender' => 'male',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user6',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_6.jpg',
            'balance' => 1000000,
            'email' => 'user6@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user7',
            'gender' => 'male',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user7',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_7.jpg',
            'balance' => 1000000,
            'email' => 'user7@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'user8',
            'gender' => 'female',
            'age' => rand(10, 30),
            'instagram_username' => 'https://www.instagram.com/user8',
            'mobile_number' => '087877778888',
            'photo' => 'photos/image_8.jpg',
            'balance' => 1000000,
            'email' => 'user8@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
