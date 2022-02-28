<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSancofaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sancofa_user', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('grand_name');
            $table->string('department');
            $table->string('sancofa_id');
            $table->string('password')->nullable();
            $table->string('university_id')->unique();
            $table->integer('approve_key');
            $table->string('phone_no');
            $table->string('role')->default('member');
            $table->boolean('activation')->default(false);
            $table->primary('sancofa_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sancofa_user');
    }
}
