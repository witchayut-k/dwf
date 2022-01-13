<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'ip'
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeOfToday($query)
    {
        return $query->whereDate('date', Carbon::today());
    }

    public function scopeOfYesterday($query)
    {
        return $query->whereDate('date', Carbon::now()->addDay(-1));
    }

    public function scopeOfMonth($query)
    {
        return $query->whereMonth('date', Carbon::now()->month);
    }

    public function scopeOfYear($query)
    {
        return $query->whereYear('date', Carbon::now()->year);
    }

}
