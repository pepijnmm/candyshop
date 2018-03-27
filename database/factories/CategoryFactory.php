<?php

$factory->define(App\Category::class, function () {
    return [
        'name' => 'Chocolate',
        'child_from' => function () {
            $returnValue = random_int(1, 10);
            if($returnValue < 5){
                return null;
            }
            return $returnValue;
        },
    ];
});
