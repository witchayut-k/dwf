<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registered extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrar_id',
        'field_value_1',
        'field_value_2',
        'field_value_3',
        'field_value_4',
        'field_value_5',
        'field_value_6',
        'field_value_7',
        'field_value_8',
        'field_value_9',
        'field_value_10'
    ];

    /**
     * Get the registrar_form that owns the Registered
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registrar_form(): BelongsTo
    {
        return $this->belongsTo(Registrar::class);
    }
}
