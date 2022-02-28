<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSancofaUserTableTable extends Migration
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
            $table->datetime('created_at');
            $table->string('full_name');
            $table->string('department');
            $table->string('sancofa_id');
            $table->string('password');
            $table->string('university_id')->unique();
            $table->string('phone_no');
            $table->string('role')->default('member');
            $table->boolean('activation')->default(false);
            $table->string('profile')->default('/image/images.png');
            $table->string('gender');
            $table->string('address')->default('unknown');
            $table->string('photo_status')->default(true);
            $table->string('payment_status')->default(true);
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
