<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleSend extends Model
{
    use HasFactory;

    protected $fillable = [
        'sendgrid_id',
        'name',
        'status',
        'categories',
        'list_ids',
        'segment_ids',
        'send_all',
        'subject',
        'suppression_group_id',
        'sender_id',
        'html_content',
        'plain_content',
        'generate_plain_content',
        'custom_unsubscribe_url',
        'ip_pool',
        'editor',
        'is_send',
        'send_at',
    ];
}
