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
    Schema::create('articles', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->longText('description');
      $table->string('route');
      $table->string('autor')->nullable();
      $table->timestamps();
      // ++Foreign
      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')->references('id')->on('categories');
      // ++ Relation Storage (Image)
      $table->unsignedBigInteger('storage_id');
      $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('articles');
  }
};
