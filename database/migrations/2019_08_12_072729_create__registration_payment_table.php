<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('member_sancofa_id');
            $table->string('active_sancofa_id');
            $table->double('amount');
            $table->year('year');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_payment');
    }
}
