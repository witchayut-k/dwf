<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $fillable = [
        'subject',
        'sender_name',
        'sender_email',
        'sender_tel',
        'note',
        'department',
    ];
}
