#!/usr/bin/env php
<?php
require_once 'src/color.php';
require_once 'src/PreParser.php';




$file = [
    "zeplab/zeplab/ZType/ListClass.zep",
    "zeplab/zeplab/ZType/StringClass.zep",
    "zeplab/zeplab/Net/TcpServer.zep",
    "zeplab/zeplab/Net/Zeliza.zep",
];

$parser = new PreParser($file);

print $parser->getErrors() . " errors found!" . PHP_EOL;
print $parser->count() . " files pre parsed" . PHP_EOL;