<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
//    	return response()->json(Category::select('id','category')->join(Tasks::class,function($join){
//            $join->on('')
//        })->get());
        return response()->json(Category::select('id','category')->get());
    }

    public function add(Request $request)
    {
    	Category::create($request->all());
    }
}

