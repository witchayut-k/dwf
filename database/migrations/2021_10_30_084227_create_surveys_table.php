<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('option_label_1')->nullable();
            $table->string('option_label_2')->nullable();
            $table->string('option_label_3')->nullable();
            $table->string('option_label_4')->nullable();
            $table->string('option_label_5')->nullable();
            $table->integer('view_count')->default(0);
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
        Schema::dropIfExists('surveys');
    }
}
