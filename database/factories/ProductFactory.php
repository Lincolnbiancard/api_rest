<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'valor' => $faker->randomFloat(2,0,10),
        'descricao' => $faker->text
    ];
});
