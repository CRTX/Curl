<?php

use CRTX\Curl\Curl;

class CurlTest extends PHPUnit_Framework_TestCase
{
    public function testCurl()
    {
        $optionList = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $Curl = new Curl('http://localhost?testvar=test', $optionList);
        $result = $Curl->execute($optionList);
        $this->assertEquals('test', $result);
    }
}
