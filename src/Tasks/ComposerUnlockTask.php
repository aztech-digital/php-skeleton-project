<?php

namespace Aztech\Skeleton\Tasks;

use Aztech\Skeleton\Task;
use Composer\IO\IOInterface;

class ComposerUnlockTask implements Task
{

    public function execute(IOInterface $io)
    {
        $io->write('Searching for composer lock file', false);

        $filename = 'composer.lock';

        if (! file_exists($filename)) {
            $io->overwrite('No lock file found, no further action taken');
            return;
        }

        if (unlink($filename)) {
            $io->overwrite('Composer lock removed');
            return;
        }

        throw new \RuntimeException('Unable to delete lock file');
    }

}
