<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('friend_id');
            $table->boolean('accepted');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('friend_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
