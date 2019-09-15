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

/**
 * Create User Factory/Seed Data
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => password_hash('password', PASSWORD_BCRYPT),
    ];
});



/**
 * Create Articles Factory/Seed Data
 */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'user_id' => random_int(1,3),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'published' => random_int(0,1),
    ];
});


