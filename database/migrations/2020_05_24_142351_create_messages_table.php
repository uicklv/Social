<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('post_id');
            $table->uuid('user_id_from');
            $table->uuid('user_id_to');
            $table->longText('content');
            $table->boolean('read');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id_from')->references('id')->on('users');
            $table->foreign('user_id_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
