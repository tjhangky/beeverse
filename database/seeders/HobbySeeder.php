<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobbies = [ 'Reading', 'Computer', 'Games', 'Social Networking', 'Playing Music', 'Listening to Music', 'Movies', 'Watching TV', 'Cooking', 'Gardening', 'Crafts', 'Playing Cards', 'Writing', 'Painting', 'Interior design', 'Animals', 'Rugby', 'American Football', 'Soccer', 'Basketball', 'Baseball', 'Sewing', 'Golf', 'Bicycling', 'Hiking', 'Walking', 'Exercise', 'Swimming', 'Skiing', 'Cricket', 'Field Hockey', 'Volleyball', 'Table Tennis', 'Bowling', 'Running', 'Dancing', 'Horseback Riding', 'Tennis', 'Motorsports', 'Athletics', 'Martial Arts', 'Badminton', 'Traveling', 'Shopping', 'Fishing', 'Hunting', 'Eating Out', 'Camping', 'Cars', 'Boating', 'Motorcycling', 'Theater', 'Snooker', 'Sports', 'Music', 'Cooking', 'Reading', 'Writing', 'Photography', 'Video Games', 'Art', 'Dancing'];
        foreach ($hobbies as $hobby) {
            Hobby::create([
                'name' => $hobby,
            ]);
        }
    }
}
