<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'price' => random_int(3, 20) * 0.50,
        'name' => $faker->name,
        'small_description' => substr($faker->paragraph,0,200),
        'description' => $faker->paragraph,
        'weight' => random_int(100, 999) / 100,
        'storage' => random_int(10000, 99999),
        'discount' => random_int(0, 2)*20,
        'image_location' => 'chocola.jpg',
    ];
});