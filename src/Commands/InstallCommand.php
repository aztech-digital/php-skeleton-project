<?php

namespace Aztech\Skeleton\Commands;

use Aztech\Skeleton\Tasks\GitInitTask;
use Aztech\Skeleton\TaskRunner;
use Aztech\Skeleton\Tasks\ComposerReplaceTask;
use Aztech\Skeleton\Tasks\ComposerUnlockTask;

use Composer\Command\Helper\DialogHelper;
use Composer\IO\IOInterface;
use Composer\IO\ConsoleIO;
use Composer\Script\Event;

use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\ProgressHelper;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class InstallCommand extends Command
{

    public function configure()
    {
        $this->setName('create-project')->setDescription('Creates a new empty project.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helpers = new HelperSet(array(
            new FormatterHelper(),
            new DialogHelper(),
            new ProgressHelper(),
            new TableHelper(),
            new QuestionHelper()
        ));

        $io = new ConsoleIO($input, $output, $helpers);

        return self::postCreateProjectInstallRun($io);
    }

    public static function postCreateProjectInstall(Event $event)
    {
        return self::postCreateProjectInstallRun($event->getIO());
    }

    private static function postCreateProjectInstallRun(IOInterface $io)
    {
        $header = <<<EOT
                       _,..__,
                   ,.'''      `"-,_
                 ,'                '.
               ,'                    '
              /                       \_
             ;     -.                   `\
             |       |     _         _    .
            ;       ,'  ,-' `.     /' `.  |
            |       '  /  o   |   t  o  \.'    .,-.
             |         |:    .'   |:    .|    /    \
             ;         \:.._./    ':_..:/ `. |      L
              \  ,-'           |\_         `\-     "'-.
  ,-"'``'-,    `f              '/`>                    `.
,'        `L___.|              '  `     . _,/            \
|                 \_          _   _    .-.]____,,r        |
\             ,. ___""----./` \,' ',`\'  \      \     mx.'
  `'-'|        '`         `|   |   |  |  |       `'--"'`
      ,         |           L_.'.__:__.-'
       \        /
        `'-- "'`
        <comment> ____  _        _      _              </comment>
        <comment>/ ___|| | _____| | ___| |_ ___  _ __  </comment>
        <comment>\___ \| |/ / _ \ |/ _ \ __/ _ \| '_ \ </comment>
        <comment> ___) |   <  __/ |  __/ || (_) | | | |</comment>
        <comment>|____/|_|\_\___|_|\___|\__\___/|_| |_|</comment>

- An <info>Aztech Digital (TM)</info> production

EOT;

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
            $runner->add('git-init', new GitInitTask());
        }

        $runner->add('composer-create-config', new ComposerReplaceTask());
        $runner->add('composer-remove-lock', new ComposerUnlockTask());

        $runner->run($io);
    }
}
