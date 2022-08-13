<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Wishlist::create([
            'user_id' => 2,
            'liked_user_id' => 1,
        ]);

        Wishlist::create([
            'user_id' => 1,
            'liked_user_id' => 4,
        ]);
        
        Wishlist::create([
            'user_id' => 4,
            'liked_user_id' => 1,
        ]);

        Wishlist::create([
            'user_id' => 5,
            'liked_user_id' => 1,
        ]);
    }
}
