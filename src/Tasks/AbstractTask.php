<?php

namespace Aztech\Skeleton\Tasks;

use Aztech\Skeleton\Task;

abstract class AbstractTask implements Task
{

    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
