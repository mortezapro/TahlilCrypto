<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            //general field
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->bigInteger("user_id");
            $table->string("thumbnail")->default("thumbnail.png");
            $table->tinyInteger("indexable")->comment("0: Noindex,1: Index")->default(0);
            $table->tinyInteger('is_special')->default(0)->comment("0: normal, 1: special");
            $table->timestamps();
            // seo field
            $table->string("canonical")->comment("Canonical Url");
            $table->string("seo_title")->nullable();
            $table->string("seo_description")->nullable();
            $table->string("seo_image")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
