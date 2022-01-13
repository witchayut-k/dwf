<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registereds', function (Blueprint $table) {
            $table->id();
            $table->integer('registrar_id');
            $table->string('field_value_1')->nullable();
            $table->string('field_value_2')->nullable();
            $table->string('field_value_3')->nullable();
            $table->string('field_value_4')->nullable();
            $table->string('field_value_5')->nullable();
            $table->string('field_value_6')->nullable();
            $table->string('field_value_7')->nullable();
            $table->string('field_value_8')->nullable();
            $table->string('field_value_9')->nullable();
            $table->string('field_value_10')->nullable();
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
        Schema::dropIfExists('registereds');
    }
}
