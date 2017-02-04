<?php

namespace CRTX\Curl\Test;

use CRTX\Curl\CurlFactory;
use CRTX\Curl\Curl;
use PHPUnit_Framework_TestCase;

class CurlFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCurlBuilder()
    {
        $CurlFactory = new CurlFactory();
        $Curl = $CurlFactory->build('Curl', array(null));
        $this->assertInstanceOf(Curl::class, $Curl);
    }
}
