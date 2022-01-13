<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->double('budget_total')->default(0)->comment('งบประมาณรวมทั้งหมด');
            $table->double('disburse_total')->default(0)->comment('เบิกจ่ายทั้งหมด');

            $table->double('budget_operate')->default(0)->comment('งบดำเนินงาน');
            $table->double('disburse_operate')->default(0)->comment('เบิกจ่าย');

            $table->double('budget_invest')->default(0)->comment('งบลงทุน');
            $table->double('disburse_invest')->default(0)->comment('เบิกจ่าย');
            
            $table->date('date');
            $table->string('budget_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
