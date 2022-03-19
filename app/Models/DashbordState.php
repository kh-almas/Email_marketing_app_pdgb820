<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashbordState extends Model
{
    use HasFactory;

    protected $fillable = [
        'range',
        'blocks',
        'bounce_drops',
        'bounces',
        'deferred',
        'delivered',
        'invalid_emails',
        'processed',
        'requests',
        'spam_report_drops',
        'spam_reports',
        'unsubscribe_drops',
        'unsubscribes',
        'clicks',
        'unique_clicks',
        'opens',
        'unique_opens',
    ];
}
