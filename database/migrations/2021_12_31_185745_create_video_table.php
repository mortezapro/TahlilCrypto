<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->bigInteger("user_id");
            $table->string("thumbnail")->default("thumbnail.png");
            $table->text("youtube_path");
            $table->longText("content");
            $table->tinyInteger("indexable")->default(1)->comment("0: Noindex,1: Index");
            $table->tinyInteger('highlight')->default(0)->comment("0: normal, 1: highlight");
            // seo field
            $table->string("canonical")->comment("Canonical Url")->nullable();
            $table->string("seo_title")->nullable();
            $table->string("seo_description")->nullable();
            $table->string("seo_image")->nullable();
            $table->timestamps();

//            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
