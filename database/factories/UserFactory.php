<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'second_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => '06-' . random_int(10000000, 99999999),
		'role'=> 0,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
