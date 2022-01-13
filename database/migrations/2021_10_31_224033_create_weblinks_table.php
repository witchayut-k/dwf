<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeblinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weblinks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('weblink_type_id')->index();
            // $table->integer('weblink_type_sub_id')->nullable()->index();
            $table->string('url')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->userstamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weblinks');
    }
}
