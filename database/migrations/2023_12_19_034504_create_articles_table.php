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
      $table->string('autor')->nullable();
      $table->unsignedBigInteger('subcategory_id');
      $table->timestamps();
      // ++Foreign
      $table->foreign('subcategory_id')->references('id')->on('subcategories');
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
