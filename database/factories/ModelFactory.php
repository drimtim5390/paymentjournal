<?php

use Faker\Generator as Faker;

//$factory->define(Model::class, function (Faker $faker) {
//    return [
//        //
//    ];
//});

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'pserie' => strtoupper($faker->randomLetter.$faker->randomLetter),
        'pnumber' => $faker->randomNumber(7),
        'pgivenby' => 'Хоразм вилояти Урганч туман ИИБ',
        'pgivendate' => $faker->date(),
        'birthdate' => $faker->date(),
        'phonenumber' => "+".$faker->randomNumber(6).$faker->randomNumber(6),
        'phonenumber1' => "+".$faker->randomNumber(6).$faker->randomNumber(6),
        'adress' => $faker->address,
        'comment' => $faker->sentence(6),
    ];
});

$factory->define(App\Export::class, function (Faker $faker) {
    $num = $faker->numberBetween(500000, 1000000);
    return [
        'summ' => $num,
        'pre' => 30,
        'com' => 3,
        'liz' => 30,
        'fem' => 12,
        'remains' => $num,
        'exportdate' => $date = $faker->date("Y-m-d"),
        'paymentdate' => $date,
    ];
});