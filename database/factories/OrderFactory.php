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
            return App\Product::all()->get(random_int()) ;
        },
        'total_price' => function () {
            $returnValue = 0.0;
            //foreach (factory(App\Product::class, 10)->create()->price as $value){
            //    $returnValue = $returnValue . $value;
            //}
            return $returnValue;
        },
        'track_code' => random_int(1000000, 99999999),
    ];
});