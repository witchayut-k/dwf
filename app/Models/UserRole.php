<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public static function options()
    {
        return (new static)::pluck('name', 'name');
    }

}
