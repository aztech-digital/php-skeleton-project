<?php

namespace Aztech\Skeleton;

class ProcessExecutor
{

    private $command;

    public function __construct($command, array $args = array())
    {
        $this->command = $command;

        if (! empty($args)) {
            $this->command .= ' ' . implode(' ', $args);
        }
    }

    public function execute()
    {
        $directory = getcwd();

        chdir($directory);

        $result = array();
        $returnCode = 0;
        exec($this->command, $result, $returnCode);

        if ($returnCode) {
            throw new \RuntimeException('Error : ' . implode(PHP_EOL, $result), $returnCode);
        }
    }
}
