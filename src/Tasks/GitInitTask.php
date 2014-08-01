<?php

namespace Aztech\Skeleton\Tasks;

use Composer\IO\IOInterface;
use Aztech\Skeleton\ProcessExecutor;
use Aztech\Skeleton\Task;

class GitInitTask implements Task
{

    public function execute(IOInterface $io)
    {
        $io->write('Initializing Git repository...');

        $init = new ProcessExecutor('git init');
        $init->execute();

        $io->write('Initialized repository !');
    }
}
