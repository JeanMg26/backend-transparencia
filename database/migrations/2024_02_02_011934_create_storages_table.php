<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('storages', function (Blueprint $table) {
      $table->id();
      $table->string('path');
      $table->timestamps();
      // ++ Relation Activity
      $table->unsignedBigInteger('activity_id');
      $table->foreign('activity_id')->references('id')->on('activities');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('storages');
  }
};