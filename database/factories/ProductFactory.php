<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'price' => random_int(001, 999) / 100,
        'name' => 'Chocolate',
        'description' => $faker->paragraph,
        'weight' => random_int(100, 999) / 100,
        'storage' => random_int(10000, 99999), // secret
        'discount' => random_int(10, 99),
        'image_location' => $faker->url,
    ];
});