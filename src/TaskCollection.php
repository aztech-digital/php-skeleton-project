<?php

namespace Aztech\Skeleton;

use Aztech\Util\Collections\TypedCollection;

class TaskCollection extends TypedCollection
{

    public function __construct()
    {
        parent::__construct('\Aztech\Skeleton\Task');
    }

    public function addTask(Task $task)
    {
        $this->addObject($task);
    }
}
