<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;
use Faker\Factory as Faker;

class PromoCodeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            PromoCode::create([
                'code' => strtoupper($faker->bothify('PROMO###')), 
                'discount_type' => $faker->randomElement(['fixed', 'percentage']),
                'discount' => $faker->numberBetween(5, 50),
                'valid_until' => $faker->dateTimeBetween('now', '+1 year'),
                'is_used' => $faker->boolean(20), 
            ]);
        }
    }
}

