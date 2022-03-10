<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_uploaded_in_sendgrid',
        'first_name',
        'last_name',
        'clist',
        'email',
        'address_line_one',
        'address_line_two',
        'city',
        'state',
        'postal_code',
        'country',
        'phone_number',
        'whatsapp',
        'facebook',
        'line',
        'alternate_emails',
        'list_ids',
        'unique_name',
        'sendgrid_id',
        'sendgrid_metadata',

    ];

    public function lists()
    {
        return $this->belongsToMany(Clist::class);
    }
}
