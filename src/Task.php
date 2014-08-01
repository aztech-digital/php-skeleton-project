<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

interface Task
{

    function getName();

    function execute(IOInterface $io);
}
