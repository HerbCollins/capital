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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\CoinLog::class, function (Faker\Generator $faker) {
    return [

    ];
});
$factory->define(App\Models\UserMiner::class, function (Faker\Generator $faker) {
    return [

    ];
});
$factory->define(App\Models\UserOrder::class, function (Faker\Generator $faker) {
    return [

    ];
});
$factory->define(App\Models\Notice::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs(5, true),
        'published_at' => $faker->dateTime('now'),
        'updated_at' => $faker->dateTime('now'),
        'created_at' => $faker->dateTime('now')
    ];
});

