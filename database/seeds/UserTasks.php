<?php

use Illuminate\Database\Seeder;
use App\Model\Tasks;
use Illuminate\Support\Str;

class UserTasks extends Seeder
{
	private $task;

	public function __construct(Tasks $tasks)
	{
		$this->task = $tasks;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory($this->task, 50)->create([
            'parent_id' => 1,
            'task' => Str::random(10),
        ]);    
    }
}
