<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendSms extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountRef',
        'clientRef',
        'messageId',
        'messagePrice',
        'network',
        'remainingBalance',
        'status',
        'to',
        'from',
        'message',
    ];
}
