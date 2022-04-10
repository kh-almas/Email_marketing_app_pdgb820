<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'sendgrid_id',
        'title',
        'subject',
        'sender_id',
        'segment_ids',
        'categories',
        'suppression_group_id',
        'custom_unsubscribe_url',
        'ip_pool',
        'html_content',
        'plain_content',
        'status',

//        list_ids


    ];


    public function lists()
    {
        return $this->belongsToMany(Clist::class, 'campaign_list');
    }

    public function suppression()
    {
        return $this->belongsTo(UnsubscribeGroup::class, 'suppression_group_id');
    }

    public function sender()
    {
        return $this->belongsTo(SenderVerification::class, 'sender_id');
    }
}
