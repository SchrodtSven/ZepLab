<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use ZepLab\ZType\StringClass;

class StringClassTest extends TestCase
{

 
    public static function setUpBeforeClass(): void
    {
       
    }

    public static function tearDownAfterClass(): void
    {
        
    }

   

    public function testFoo(string $og= "foo", string $st="f", $c="oo", string $en = "o", string $nc ="blabla")
    {
        $my = new StringClass($og);
        $this->assertSame((string) $my, $og);

        $this->assertTrue($my->begins($st));
        $this->assertTrue($my->ends($en));
        $this->assertTrue($my->has($c));

        $this->assertFalse($my->has($nc));


    }

    public function testifSplittingWorxCorrectly(string $og= "foo bar baz")
    {
        $my = new StringClass($og);
        
        $tmp = $my->splitBy();
        
        $this->assertTrue(is_array($tmp));

    }
}