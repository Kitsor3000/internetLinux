<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    public function run()
    {
        Price::create([
            'booking_type' => 'training',
            'pricing_type' => 'one_time',
            'price' => 90,
        ]);

        Price::create([
            'booking_type' => 'training',
            'pricing_type' => 'booking',
            'price' => 87.5,
        ]);

        Price::create([
            'booking_type' => 'game',
            'pricing_type' => 'one_time',
            'price' => 60,
        ]);

        Price::create([
            'booking_type' => 'game',
            'pricing_type' => 'booking',
            'price' => 55,
        ]);

        Price::create([
            'booking_type' => 'sublease',
            'pricing_type' => 'one_time',
            'price' => 60,
        ]);

        Price::create([
            'booking_type' => 'sublease',
            'pricing_type' => 'booking',
            'price' => 55,
        ]);
    }
}
