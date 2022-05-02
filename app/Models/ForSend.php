<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForSend extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'from',
        'message',
        'is_queue',
    ];
}
