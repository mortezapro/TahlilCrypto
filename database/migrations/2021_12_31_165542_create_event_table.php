<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("thumbnail")->default("thumbnail.png");
            $table->longText("content");
            $table->tinyInteger("indexable")->default(0)->comment("0: Noindex,1: Index");
            $table->tinyInteger('highlight')->default(0)->comment("0: normal, 1: highlight");
            $table->timestamp('event_date')->default(DB::raw("CURRENT_TIMESTAMP"));
            // seo field
            $table->string("canonical")->comment("Canonical Url")->nullable();
            $table->string("seo_title")->nullable();
            $table->string("seo_description")->nullable();
            $table->string("seo_image")->nullable();
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
        Schema::dropIfExists('event');
    }
}
