<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('pserie',2);
            $table->string('pnumber',7);
            $table->string('pgivenby',400);
            $table->date('pgivendate');
            $table->date('birthdate');
            $table->string('phonenumber',50);
            $table->string('phonenumber1',50)->nullable();
            $table->string('adress',500);
            $table->string('comment',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
