<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use ZepLab\ZType\ListClass;

class ListClassTest extends TestCase 
{


    public static function setUpBeforeClass(): void {}

    public static function tearDownAfterClass(): void {}

    public function testFoundation(): void
    {
        $foo = ["id" =>  23, 44, 444];
        $bar = [23, 44, 444];
    
        $this->assertTrue(2 == 1+1);

        $fooL = new ListClass($foo);
        $barL = new ListClass($bar);
         for($i=0;$i<count($foo);$i++) {
            $this->assertSame($fooL[$i], $barL[$i]);
        }
        
        
    }
}
