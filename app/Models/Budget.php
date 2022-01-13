<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    public $timestamps = false;

    protected $casts = [
        'date' => 'date'
    ];

    protected $fillable = [
        'date',
        'budget_year',
        'budget_total',
        'disburse_total',
        'budget_operate',
        'disburse_operate',
        'budget_invest',
        'disburse_invest'
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSTORS
    |--------------------------------------------------------------------------
    */

    public function getDisburseTotalPercentAttribute () {
        if ($this->budget_total == 0) return 0;
        return $this->disburse_total / $this->budget_total * 100;
    }

    public function getDisburseOperatePercentAttribute () {
        if ($this->budget_operate == 0) return 0;
        return $this->disburse_operate / $this->budget_operate * 100;
    }

    public function getDisburseInvestPercentAttribute () {
        if ($this->budget_invest == 0) return 0;
        return $this->disburse_invest / $this->budget_invest * 100;
    }

    public function getDateThAttribute () {
        return $this->date ? $this->date->addYear(543)->translatedFormat('j M Y') : "";
    }
}
