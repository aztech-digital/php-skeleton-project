<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

interface Task
{

    function execute(IOInterface $io);
}
