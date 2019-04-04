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
		$list = Category::all();
		$main = $this->CreateTree($list);
		return response()->json($main);
	}

	public function add(Request $request)
	{	
		$id = Category::create($request->all());
		return response()->json($id->id);
	}

	public function CreateTree($array,$sub=0)
	{
	    $a = array();
	    foreach($array as $v)
	    {
	        if($sub == $v['parent_id'])
	        {
	            $b = $this->CreateTree($array,$v['id']);
	            if(!empty($b)){
		            $a[$v['id']]['name'] = $v['category'];
		        	$a[$v['id']]['children'] = $b;
	        	}
	            else
	            $a[$v['id']]['name'] = $v['category'];
	        }
	    }
	    return $a;
	}

}	

