<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'category_id' => $faker->numberBetween($min =1, $max=10),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'description' => $faker->paragraph,


    ];
});
