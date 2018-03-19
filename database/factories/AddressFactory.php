<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return random_int(1, 10);
        },
        'street_name' => $faker->streetName,
        'house_number' => random_int(1, 100),
        'zip_code' => $faker->postcode,
    ];
});
