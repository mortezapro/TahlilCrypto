<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable()->default(null);
            $table->longText("content");
            $table->bigInteger("reply_id")->nullable()->default(null);
            $table->integer("status")->default(config("comment-status.initialRegistration"))->comment("0:initialRegistration, 1010:enabled,1015:disabled");
            $table->bigInteger("commentable_id");
            $table->string("commentable_type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
