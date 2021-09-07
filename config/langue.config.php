<?php

use Symfony\Component\Yaml\Yaml;

$strings = Yaml::parseFile(__DIR__ . '/strings.yml');

define("APP_STRINGS", $strings);