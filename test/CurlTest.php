<?php

use CRTX\Curl\Curl;

class CurlTest extends PHPUnit_Framework_TestCase
{
    public function testCurl()
    {
        $optionList = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $curlHandle = curl_init('http://localhost?testvar=test');
        $Curl = new Curl($curlHandle, $optionList);
        $actual = $Curl->execute();
        $this->assertEquals('test', $actual);
    }

    public function testCurlError()
    {
        $optionList = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $curlHandle = curl_init('http://invalidHost');
        $Curl = new Curl($curlHandle, $optionList);
        $actual = $Curl->execute();
        $this->assertTrue(!empty($Curl->getError()));
    }
    
    public function testInvalidCurlHandle()
    {
        $this->expectException(InvalidArgumentException::class);
        $Curl = new Curl(null, []);
        $Curl->execute();
    }
}
