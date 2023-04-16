<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifiedPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'post_id'
    ];
}
