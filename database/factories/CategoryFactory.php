<?php

$factory->define(App\Category::class, function () {
    return [
        'name' => 'Chocolate',
        'child_from' => function () {
            return random_int(1, 10);
        },
    ];
});
