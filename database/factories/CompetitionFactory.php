<?php

use App\Competition;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Competition::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber,
        'sport' => $faker->jobTitle,
        'icon' => 'golf_course',
        'score_home' => $faker->randomNumber,
        'score_away' => $faker->randomNumber
    ];
});
