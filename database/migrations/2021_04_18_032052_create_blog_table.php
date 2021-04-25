<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->longText('body');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete(Cascade);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete(Cascade);
            $table->foreign('status_id')->references('id')->on('status')->onDelete(Cascade);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
