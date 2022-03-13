<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bounce extends Model
{
    use HasFactory;

    protected $fillable = [
        'created',
        'email',
        'reason',
        'status',
    ];
}
