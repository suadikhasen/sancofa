<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedUserTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_user', function (Blueprint $table) {
            $table->timestamps();
            $table->string('member_sancofa_id');
            $table->string('admin_sancofa_id');
            $table->primary('member_sancofa_id');
            $table->foreign('member_sancofa_id')->references('sancofa_id')->on('sancofa_user')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_user');
    }
}
