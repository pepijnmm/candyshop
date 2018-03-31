<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
        'child_from' => function () {
            $returnValue = random_int(1, 10);
            if($returnValue < 5){
                return null;
            }
            return $returnValue;
        },
    ];
});
