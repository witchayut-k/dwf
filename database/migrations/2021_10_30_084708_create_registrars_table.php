<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrars', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('begin_date')->nullable();
            $table->date('end_date')->nullable();

            $table->text('option_label_1')->nullable();
            $table->text('option_label_2')->nullable();
            $table->text('option_label_3')->nullable();
            $table->text('option_label_4')->nullable();
            $table->text('option_label_5')->nullable();
            $table->text('option_label_6')->nullable();
            $table->text('option_label_7')->nullable();
            $table->text('option_label_8')->nullable();
            $table->text('option_label_9')->nullable();
            $table->text('option_label_10')->nullable();

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
        Schema::dropIfExists('registrars');
    }
}
