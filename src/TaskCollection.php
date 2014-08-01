<?php

namespace Aztech\Skeleton;

use Aztech\Util\Collections\TypedCollection;
use Aztech\Util\Collections\TypedDictionary;

class TaskCollection extends TypedDictionary
{

    public function __construct()
    {
        parent::__construct('\Aztech\Skeleton\Task');
    }

    public function add($name, Task $task)
    {
        $this->setKey($name, $task);
    }
}
