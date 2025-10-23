#!/usr/bin/env php
<?php
require_once 'src/color.php';
require_once 'src/PreParser.php';




$file = [
    "zeplab/zeplab/Foo.zep",
];

$parser = new PreParser($file);
$parser->setStopOnError(true);
print $parser->getErrors() . " errors found!" . PHP_EOL;
print $parser->count() . " files pre parsed" . PHP_EOL;