<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'episode' => $faker->text(50),
        'body' => $faker->text(500),
        'comments_allowed' => (bool)random_int(0, 1),
        'user_id' => function(){
            return factory(User::class)->create()->id;
        }

    ];
});
