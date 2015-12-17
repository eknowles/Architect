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

$factory->define(
    App\User::class,
    function (Faker\Generator $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt(str_random(10)),
            'remember_token' => str_random(10),
        ];
    }
);

$factory->define(
    App\Media::class,
    function (Faker\Generator $faker) {
        return [
            'path' => $faker->imageUrl(640, 480, 'city'),
            'credit' => $faker->name,
            'caption' => $faker->sentence,
        ];
    }
);

$factory->define(
    App\Project::class,
    function (Faker\Generator $faker) {
        return [
            'client' => $faker->company,
            'title' => $faker->sentence(4),
            'location' => $faker->city.', '.$faker->country,
            'size' => $faker->word,
            'slug' => $faker->slug,
            'public' => $faker->boolean(70),
            'completed' => $faker->date,
            'photo' => $faker->imageUrl(640, 480, 'city'),
            'keywords' => str_replace(' ', ', ', $faker->sentence),
            'number' => $faker->unique()->numberBetween(1, 400),
            'description' => $faker->text()
        ];
    }
);
