<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //general field
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->string("thumbnail")->default("thumbnail.png");
            $table->string("description");
            $table->longText("content");
            $table->bigInteger("user_id")->unsigned();
            $table->tinyInteger("indexable")->default(1)->comment("0: Noindex,1: Index");
            $table->tinyInteger('is_special')->default(0)->comment("0: normal, 1: special");
            $table->tinyInteger('highlight')->default(0)->comment("0: normal, 1: highlight");
            $table->integer('status')->default(config("post-status.initialRegistration"))->comment("0:initialRegistration, 1010: published, 1020: rejected");
            $table->timestamps();
            // seo field
            $table->string("canonical")->comment("Canonical Url")->nullable();
            $table->string("seo_title")->nullable();
            $table->string("seo_description")->nullable();
            $table->string("seo_image")->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
