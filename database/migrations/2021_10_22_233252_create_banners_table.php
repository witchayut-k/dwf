<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->integer('sequence')->default(0);
            $table->boolean('published')->default(false);

            $table->integer('view_count')->default(0);
            $table->integer('click_count')->default(0);

            $table->timestamps();
            $table->userstamps();
        });
    }

    /**
     * Reverse the migrations.l  
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
