<?php

use App\Models\Guest;
use Faker\Generator as Faker;



$factory->define(App\Models\Visit::class, function (Faker $faker) {

    $guests = Guest::all()->pluck('id')->toArray();

    return [
        'guest_id' => $faker->randomElement($guests),
        'time' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
