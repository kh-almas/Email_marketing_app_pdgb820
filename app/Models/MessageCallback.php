<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageCallback extends Model
{

    use HasFactory;

    protected $fillable = [
        'include_subaccounts',
        'account_id',
        'message_id',
        'account_ref',
        'client_ref',
        'direction',
        'from',
        'to',
        'forced_from',
        'message_body',
        'concatenated',
        'network',
        'network_name',
        'country',
        'country_name',
        'date_received',
        'date_finalized',
        'latency',
        'status',
        'error_code',
        'error_code_description',
        'currency',
        'total_price',
        'm_id',
        'dcs',
        'validity_period',
        'ip_address',
    ];
}
