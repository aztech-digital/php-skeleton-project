<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

class TaskRunner extends TaskCollection
{

    public function run(IOInterface $io)
    {
        $subIo = new IndentingIoInterfaceDecorator($io, 6);

        foreach ($this as $name => $task) {
            $io->write('  - Executing task <info>' . $name . '</info>');
            $task->execute($subIo);
            $io->write('');
        }

        $io->write(array('Successfully executed all tasks', ''));
    }
}
