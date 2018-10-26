<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CardUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('card_users', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('card_id')
                ->references('id')
                ->on('cards');
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
        Schema::table('card_users', function (Blueprint $table) {
            $table->dropForeign(['card_id', 'user_id']);
        });
        Schema::dropIfExists('card_users');
        //
    }
}
