<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->text('tags')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('pinned')->default(false);
            $table->boolean('published')->default(false);
            $table->integer('content_type_id')->index();

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
        Schema::dropIfExists('contents');
    }
}
