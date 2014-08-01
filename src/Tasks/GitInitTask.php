<?php

namespace Aztech\Skeleton\Tasks;

use Composer\IO\IOInterface;
use Aztech\Skeleton\ProcessExecutor;

class GitInitTask extends AbstractTask
{

    public function execute(IOInterface $io)
    {
        $io->write('Initializing Git repository...');
        
        $init = new ProcessExecutor('git init');
        $init->execute();
        
        $io->write('Initialized repository !');
    }
}
