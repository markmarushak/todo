<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
    	return response()->json(Category::select('id','category')->where('parent_id',Auth::id())->get());
    }
}
