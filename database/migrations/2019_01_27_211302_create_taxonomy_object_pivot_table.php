<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyObjectPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy_object', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('taxonomy_id')->unsigned();
            $table->integer('obj_id')->unsigned();
            $table->string('obj_type', 100);

            $table->engine = 'InnoDB';
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomy_object');
    }
}
