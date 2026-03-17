<?php
use ZepLab\Core\Foo;
use ZepLab\ZType\StringClass;
use ZepLab\ZType\ListClass;



$foo = new StringClass("Foo bar baz");
var_dump($foo->splitBy());



var_dump($foo->parseQuery("id=666&name=Satan&Salary=42"));

$bar = [23, 44, 444];
var_dump(new ListClass($bar));


$bar = ["id" =>  23, 44, 444];
var_dump(new ListClass($bar));


