<?php

namespace Aztech\Skeleton;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Script\Event;

class InstallCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return self::postCreateProjectInstall();
    }

    public static function postCreateProjectInstall(Event $event)
    {
        /* @var $io \Composer\IO\IOInterface */
        $io = $event->getIO();

        $projectName = $io->ask('Project name (vendor/package format) : ', null);
        $initGit = $io->askConfirmation('Initialize Git repository (y/N) ? ', false);

        $io->write(array(
            '',
            'Thank you, now creating project <info>' . $projectName . '</info>',
            ''
        ));

        if ($initGit) {
            $io->write('Initializing Git repository...');

            $init = new ProcessExecutor('git init');
            $init->execute();

            $io->write('Initialized repository !');
        }
    }
}
