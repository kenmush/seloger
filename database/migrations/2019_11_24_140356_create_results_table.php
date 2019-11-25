<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website')->nullable();
            $table->string('url')->nullable();
            $table->string('postcode')->nullable();
            $table->string('price')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            $table->string('m2')->nullable();
            $table->string('rooms')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('results');
    }
}
