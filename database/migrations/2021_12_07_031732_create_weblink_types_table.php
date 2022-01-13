<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeblinkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weblink_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('example_image')->nullable();
            $table->integer('parent_type_id')->nullable()->index();
            $table->boolean('published')->default(false);
            $table->integer('sequence')->default(0);
            $table->timestamps();
            $table->userstamps();
            $table->softDeletes();
            $table->softUserstamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weblink_types');
    }
}
