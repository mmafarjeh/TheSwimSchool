<?php

use Faker\Generator as Faker;

$factory->define(App\Lesson::class, function (Faker $faker) {
    return [
        'season_id' => factory('App\Season')->create()->id,
        'group_id' => factory('App\Group')->create()->id,
        'location_id' => factory('App\Location')->create()->id,
        'price' => $faker->numberBetween(1, 150),
        'class_start_date' => $faker->dateTimeBetween('now', '+1 month'),
        'class_end_date' => $faker->dateTimeBetween('now', '+10 months'),
        'registration_open' => $faker->dateTimeBetween('-1 month', 'now'),
        'class_start_time' => $faker->dateTime(),
        'class_end_time' => $faker->dateTimeAd('+1 hour')
    ];
});
