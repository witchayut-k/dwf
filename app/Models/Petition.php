<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'subject',
        'detail',
        'prefix',
        'first_name',
        'last_name',
        'tel',
        'email',
        'province',
        'amphur',
        'tambol',
        'zipcode',
        'reply',
        'replied_at',
        'replied_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | SEARCHING
    |--------------------------------------------------------------------------
    */

    public static function searchFields()
    {
        return [
            'subject',
        ];
    }
}
