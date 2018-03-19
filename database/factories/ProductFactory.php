<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'price' => random_int(001, 999) / 100,
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'weight' => random_int(100, 999) / 100,
        'storage' => random_int(10000, 99999), // secret
        'discount' => random_int(10, 99),
        'image_location' => 'chocola.jpg',
    ];
});