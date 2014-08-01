<?php

namespace Aztech\Skeleton;

use Composer\IO\IOInterface;

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
        if (is_array($messages)) {
            foreach ($messages as & $message) {
                $message = str_repeat(' ', $this->indent) . $message;
            }
        } elseif (is_string($messages)) {
            $messages = str_repeat(' ', $this->indent) . $message;
        }

        return $this->io->write($messages, $newline);
    }

    public function overwrite($messages, $newline = true, $size = null)
    {
        return $this->io->overwrite($messages, $newline, $size);
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
