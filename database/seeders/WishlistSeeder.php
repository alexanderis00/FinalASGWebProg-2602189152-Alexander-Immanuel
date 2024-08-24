<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        Wishlist::create([
            'user_id' => 1,
            'wishlisted_user_id' => 2,
        ]);

        Wishlist::create([
            'user_id' => 2,
            'wishlisted_user_id' => 3,
        ]);

        // Add more seed data as needed
    }
}
