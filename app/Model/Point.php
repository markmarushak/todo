<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['task_id', 'point','created_at','updated_at'];
}
