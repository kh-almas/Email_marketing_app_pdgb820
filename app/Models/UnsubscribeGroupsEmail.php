<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsubscribeGroupsEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
    ];

    public function group()
    {
        return $this->belongsTo(UnsubscribeGroup::class, 'unsubscribe_group_id');
    }
}
