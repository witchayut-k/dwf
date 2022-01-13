<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();

            $table->string('type_name');
            $table->string('subject');
            $table->longText('detail')->nullable();

            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('province')->nullable();
            $table->string('amphur')->nullable();
            $table->string('tambol')->nullable();
            $table->string('zipcode')->nullable();

            $table->string('reply')->nullable();

            $table->timestamps();
            $table->timestamp('replied_at')->nullable();
            $table->integer('replied_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petitions');
    }
}
