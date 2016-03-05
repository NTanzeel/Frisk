<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stolen_item_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->boolean('blocked');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('conversations');
    }
}
