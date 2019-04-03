<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category', 'parent_id'];

    protected $arttibute = [
    	'parent_id' => 0
    ];

    public $timestamps = true;
}
