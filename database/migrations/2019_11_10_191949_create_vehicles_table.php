<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('brand');
            $table->string('model');
            $table->string('body_type');
            $table->string('type');
            $table->float('price');
            $table->integer('year');
            $table->float('mileage');
            $table->string('transmission');
            $table->integer('doors');
            $table->string('fuel');
            $table->string('color');
            $table->string('plate');
            $table->boolean('is_change');
            $table->text('observation');
            $table->text('accessories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
