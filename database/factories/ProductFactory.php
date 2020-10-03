<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => rand(20000, 400000),
        'description' => $faker->sentence,
        'stock' => rand(0, 100),
        'category_id' => function() {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'created_at' => now()
    ];
});
