<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

class TaskRunner extends TaskCollection
{

    public function run(IOInterface $io)
    {
        foreach ($this as $task) {
            $io->write('- Executing task <info>' . $task->getName() . '</info>');

            $task->execute($io);
        }
    }
}
