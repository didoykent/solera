<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Report extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function(Blueprint $table){

         $table->increments('id');
         $table->string('cubeNumber')->nullable();
         $table->string('phoneModel')->nullable();
         $table->string('ktt')->nullable();
         $table->string('nizz')->nullable();
         $table->string('tmg')->nullable();
         $table->string('noUnit')->nullable();
         $table->string('teacher')->nullable();
         $table->rememberToken();
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
      Schema::dropIfExists('report');
    }
}
