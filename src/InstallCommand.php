<?php

namespace Aztech\Skeleton;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Script\Event;
use Aztech\Skeleton\Tasks\GitInitTask;

class InstallCommand extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return self::postCreateProjectInstall();
    }

    public static function postCreateProjectInstall(Event $event)
    {
        $header = <<<EOT

   _____            __                .__      __________      .__.__       .___
  /  _  \ _________/  |_  ____   ____ |  |__   \______   \__ __|__|  |    __| _/___________
 /  /_\  \\___   /\   __\/ __ \_/ ___\|  |  \   |    |  _/  |  \  |  |   / __ |/ __ \_  __ \
/    |    \/    /  |  | \  ___/\  \___|   Y  \  |    |   \  |  /  |  |__/ /_/ \  ___/|  | \/
\____|__  /_____ \ |__|  \___  >\___  >___|  /  |______  /____/|__|____/\____ |\___  >__|
        \/      \/           \/     \/     \/          \/                    \/    \/


EOT;

        /* @var $io \Composer\IO\IOInterface */
        $io = $event->getIO();

        $io->write($header);

        $projectName = $io->ask('Project name (vendor/package format) : ', null);
        $initGit = $io->askConfirmation('Initialize Git repository (y/N) ? ', false);

        $io->write(array(
            '',
            'Thank you, now creating project <info>' . $projectName . '</info>',
            ''
        ));

        $runner = new TaskRunner();

        if ($initGit) {
            $runner->add(new GitInitTask());
        }

        $runner->run($io);
    }
}
