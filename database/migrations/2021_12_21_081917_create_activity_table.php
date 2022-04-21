<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("record_id");
            $table->string("subject");
            $table->bigInteger("user_id")->unsigned();
            $table->string("table_name");
            $table->string("method")->comment("post, put, get");
            $table->string("ip_address");
            $table->string("user_agent");
            $table->string("url");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
