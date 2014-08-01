<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;
use Composer\Config;

class IndentingIoInterfaceDecorator implements IOInterface
{

    private $io;

    private $indent;

    public function __construct(IOInterface $io, $indent = 0)
    {
        $this->io = $io;
        $this->indent = $indent;
    }

    public function isInteractive()
    {
        return $this->io->isInteractive();
    }

    public function isVerbose()
    {
        return $this->io->isVerbose();
    }

    public function isVeryVerbose()
    {
        return $this->isVeryVerbose();
    }

    public function isDebug()
    {
        return $this->isDebug();
    }

    public function isDecorated()
    {
        return $this->isDecorated();
    }

    public function write($messages, $newline = true)
    {
        $this->rewriteContent($messages);

        return $this->io->write($messages, $newline);
    }

    public function overwrite($messages, $newline = true, $size = null)
    {
        $this->rewriteContent($messages);

        return $this->io->overwrite($messages, $newline, $size);
    }

    private function rewriteContent(& $messages)
    {
        if (is_array($messages)) {
            foreach ($messages as & $message) {
                $this->rewriteContent($message);
            }
        }
        else {
            $messages = str_repeat(' ', $this->indent) . '<comment>' . strip_tags($messages) . '</comment>';
        }
    }

    public function ask($question, $default = null)
    {
        return $this->io->ask($question, $default);
    }

    public function askConfirmation($question, $default = true)
    {
        return $this->io->askConfirmation($question, $default);
    }

    public function askAndValidate($question, $validator, $attempts = false, $default = null)
    {
        return $this->io->askAndValidate($question, $validator, $attempts, $default);
    }

    public function askAndHideAnswer($question)
    {
        return $this->io->askAndHideAnswer($question);
    }

    public function getAuthentications()
    {
        return $this->io->getAuthentications();
    }

    public function hasAuthentication($repositoryName)
    {
        return $this->io->hasAuthentication($repositoryName);
    }

    public function getAuthentication($repositoryName)
    {
        return $this->io->getAuthentication($repositoryName);
    }

    public function setAuthentication($repositoryName, $username, $password = null)
    {
        return $this->io->setAuthentication($repositoryName, $username, $password);
    }

    public function loadConfiguration(Config $config)
    {
        return $this->io->loadConfiguration($config);
    }
}
