<?php

namespace CRTX\Curl\Test;

use CRTX\Curl\MultiCurlFactory;
use CRTX\Curl\MultiCurl;
use PHPUnit_Framework_TestCase;

class MultiCurlFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testMultiCurlBuilder()
    {
        $option = array(CURLOPT_RETURNTRANSFER => true);

        $parameterList = array(
            array(
                'url' => 'http://localhost?testvar=test1'
            ),
            array(
                'url' => 'http://localhost?testvar=test2'
            )
        );
        $CurlFactory = new MultiCurlFactory();
        $Curl = $CurlFactory->build('MultiCurl', $parameterList);
        $this->assertInstanceOf(MultiCurl::class, $Curl);
    }
}
