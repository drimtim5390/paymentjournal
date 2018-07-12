<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer::class,50)->create()->each(function($customer){
            $customer->export()->save(factory(App\Export::class)->make());
        });
    }

}
