<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PromoCode::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'discount_percent' => $faker->numberBetween(1, 100),
    ];
});
