<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sendgrid_id',
        'nickname',
        'from_email',
        'from_name',
        'reply_to',
        'reply_to_name',
        'address',
        'address2',
        'state',
        'city',
        'country',
        'zip',
        'verified',
        'locked',
    ];
}
