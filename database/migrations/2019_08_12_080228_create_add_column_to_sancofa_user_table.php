<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddColumnToSancofaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sancofa_user', function (Blueprint $table) {
            
            $table->boolean('photo_status');
            $table->boolean('payment_status');
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

            $table->dropColumn(['photo_status','payment_status']);
            
        });
    }
}
