<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleriables', function (Blueprint $table) {
            $table->bigInteger("galleriable_id");
            $table->bigInteger("gallery_model_id");
            $table->string("galleriable_type");

            $table->primary(["galleriable_id","gallery_model_id","galleriable_type"],"galleriables");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleriables');
    }
}
