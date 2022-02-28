<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_id');
            $table->string('giver_id');
            $table->string('reciever_id');
            $table->date('giving_date');
            $table->date('returned_date');
            $table->integer('punishment')->default(0);
            $table->boolean('approve')->default(false);
            $table->foreign('reciever_id')->references('sancofa_id')->on('sancofa_user')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_members');
    }
}
