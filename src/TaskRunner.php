<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

class TaskRunner extends TaskCollection
{

    public function run(IOInterface $io)
    {
        foreach ($this as $name => $task) {
            $io->write('- Executing task <info>' . $name . '</info>');

            $task->execute($io);
        }
    }
}
