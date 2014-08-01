#!/usr/bin/env php
<?php

use Aztech\Skeleton\Commands\InstallCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$application = new Application('skeleton', '@package_version@');

$application->add(new InstallCommand());
$application->run();
