<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'task','parent_id','created_at','updated_at','category_id','trophy','dedline','public'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];
}
