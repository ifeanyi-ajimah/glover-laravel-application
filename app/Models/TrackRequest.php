<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackRequest extends Model
{
    use HasFactory;
    protected $fillable = ['request_type','status','user_id','request_data','creator_id'];

    protected $casts = [
        'request_data' => 'array',
    ];
    
}

