<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph,
        'owner_id'=>auth()->user()->getId()
//            function(){
//        return factory(\App\User::class)->create()->id;
//        }

    ];
});
