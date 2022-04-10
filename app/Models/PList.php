<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function number()
    {
        return $this->belongsToMany(PhoneNumber::class,'list_number');
    }
}
