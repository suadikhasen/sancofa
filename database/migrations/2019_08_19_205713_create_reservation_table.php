<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('book_id');
            $table->string('user_id');
            $table->datetime('return_date')->nullable();
            $table->boolean('reserved')->default(false);
            $table->boolean('continue')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserved_books');
    }
}
