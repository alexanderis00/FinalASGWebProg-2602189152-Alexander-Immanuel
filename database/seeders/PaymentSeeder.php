<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'user_id' => 1,
            'amount' => 100.00,
        ]);

        Payment::create([
            'user_id' => 2,
            'amount' => 50.00,
        ]);

        // Add more seed data as needed
    }
}
