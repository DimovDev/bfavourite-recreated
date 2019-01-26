<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->string('asset_type', 50);
            $table->string('asset_status', 50);
            $table->string('slug', 500);
            $table->string('summary', 500)->nullable(true);
            $table->timestamp('published_at')->nullable(true);
            $table->timestamps();
            $table->engine = "InnoDB";
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
