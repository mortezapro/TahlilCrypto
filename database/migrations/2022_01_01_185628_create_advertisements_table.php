<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("position_id")->unsigned();
            $table->integer("status")->comment("1010: enabled, 1015: disabled")->default(config("advertisement-status.disabled"));
            $table->bigInteger("user_id")->nullable();
            $table->integer("duration")->comment("per days");
            $table->string("image_path");
            $table->timestamps();

            $table->foreign("position_id")->references("id")->on("positions")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
