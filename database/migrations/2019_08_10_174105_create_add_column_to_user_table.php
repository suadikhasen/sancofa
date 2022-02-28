<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddColumnToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sancofa_user', function (Blueprint $table) {
            
            $table->string('gender');
            $table->string('address')->default('unknown');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sancofa_user', function (Blueprint $table) {
            $table->dropColumn(['gender','address']);
        });
    }
}
