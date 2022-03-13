<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsubscribeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sendgrid_id',
        'is_default',
    ];
}
