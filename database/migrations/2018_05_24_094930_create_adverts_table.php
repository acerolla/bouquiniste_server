<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('author')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->float('price', 10, 2);
            $table->string('status')->default('active');

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');

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
        Schema::dropIfExists('adverts');
    }
}
