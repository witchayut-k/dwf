<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('menu_type_id')->default(1);
            $table->integer('content_id')->nullable()->index();
            $table->integer('sequence')->default(0);
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->boolean('published')->default(true);
            $table->string('menu_position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
