<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->company . "'s Event",
        'description' => $faker->paragraphs(3, true),
        'location' => $faker->city . ', ' . $faker->country,
        'is_highlighted' => $faker->boolean(40),
        'image_url' => 'http://samueldking.co.uk/images/1288481786_1.jpg'
    ];
});
