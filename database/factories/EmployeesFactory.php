<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        //
        'employee_first_name' => $faker->name(),
        'employee_last_name' => $faker->name(),
        'employee_email' => $faker->email,
    ];
});
