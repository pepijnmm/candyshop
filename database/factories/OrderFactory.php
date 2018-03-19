<?php

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

$factory->define(App\Order::class, function () {
    return [
        'user_id' => function () {
            return random_int(1, 10) ;
        },
        'status' => array_random(['active', 'paid', 'send', 'received']),
        'total_price' => random_int(9, 99),
        'track_code' => random_int(1000000, 99999999),
    ];
});