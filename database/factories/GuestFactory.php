<?php

use App\Models\Guest;
use Faker\Generator as Faker;

$factory->define(Guest::class, function (Faker $faker) {
    $gender = $faker->randomElement(['мужской', 'женский']);
    $name = $faker->name($gender);
    return [
        'name' => $name,
        'gender' => $gender,
        'birthday' => $faker->date('Y-m-d',$max = 'now')
    ];
});