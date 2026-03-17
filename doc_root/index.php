<?php
use ZepLab\Core\Foo;
use ZepLab\ZType\StringClass;
use ZepLab\ZType\ListClass;



$foo = new StringClass("Foo bar baz");
var_dump($foo->splitBy());
