<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLinks extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'id',
        'thread_id',
        'link',
        'flag'
    ];

}
