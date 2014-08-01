<?php

namespace Aztech\Skeleton\Tasks;

use Aztech\Skeleton\Task;
use Composer\IO\IOInterface;

class ComposerReplaceTask implements Task
{

    public function execute(IOInterface $io)
    {
        $io->write(getcwd());
    }
}
