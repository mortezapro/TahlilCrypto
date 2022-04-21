<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("subject");
            $table->integer("priority")->comment("1010:low, 1011:medium, 1012: high");
            $table->longText("content");
            $table->string("image")->nullable();
            $table->integer("user_id");
            $table->integer("department_id")->unsigned();
            $table->integer("status")->default(1010)->comment("1010: initialRegistration, 1011: enabled, 1012: disabled");
            $table->timestamps();

//            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
//            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
