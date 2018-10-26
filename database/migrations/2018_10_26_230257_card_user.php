<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CardUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('card_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('card_id');
            $table->foreign('card_id')
                ->references('id')
                ->on('cards');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_user', function (Blueprint $table) {
            $table->dropForeign(['card_id', 'user_id']);
        });
        Schema::dropIfExists('card_user');
        //
    }
}
