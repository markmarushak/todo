<?php

namespace App\Repository;

use App\Model\Category;
use App\Model\Point;
use App\Model\Tasks;
use Illuminate\Database\Eloquent\Model;

class TaskRepository
{
    protected $category;
    protected $point;
    protected $task;
    public function __construct(
        Tasks $tasks,
        Category $category,
        Point $point)
    {
        $this->task = $tasks;
        $this->category = $category;
        $this->point = $point;
    }

    public function addTask($data)
    {
        if(!$data['category_type']){
            $category_id = $this->category::create([
                'parent_id' => $data['parent_id'],
                'category' => $data['category']
            ]);
        }else{
            $category_id = $data['category'];
        }

        $task_id = $this->task::create([
            'parent_id'   => $data['parent_id'],
            'task'        => $data['task'],
            'category_id' => $category_id->id,
            'trophy'      => $data['trophy'],
            'dedline'     => $data['dedline']
        ]);

        foreach ($data['points'] as $point)
        {
            $this->point::create([
                'task_id' => $task_id->id,
                'point'   => $point
            ]);
        }
    }
}
