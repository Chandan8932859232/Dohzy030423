<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loan::class, function (Faker $faker) {
    return [
        'applicant_first_name' => $faker->name(),
        'applicant_last_name' => $faker->name(),
        'application_amount' => $faker->randomNumber()
    ];
});
