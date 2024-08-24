<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Friend;

class FriendSeeder extends Seeder
{
    public function run(): void
    {
        Friend::create([
            'user_id' => 1,
            'friend_id' => 2,
        ]);

        Friend::create([
            'user_id' => 2,
            'friend_id' => 3,
        ]);

        // Add more seed data as needed
    }
}
