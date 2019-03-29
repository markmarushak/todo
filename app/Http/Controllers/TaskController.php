<?php

namespace App\Http\Controllers;

use App\Repository\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tasks;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{	

	protected $task;
    protected  $tr;
	public function __construct(
	    Tasks $tasks,
        TaskRepository $taskRepository)
    {
        $this->task = $tasks;
        $this->tr = $taskRepository;
    }

    public function index()
    {
    	return view('task.show');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $id = Auth::id();
    	return response()->json(Tasks::where('parent_id', $id)->get());
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $data['main']['parent_id'] = Auth::id();
        $this->tr->addTask($data['main']);
    }
}
