<?php

use CRTX\Curl\CurlFactory;

class CurlTest extends PHPUnit_Framework_TestCase
{
    public function testCurl()
    {
        $optionList = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $url = 'http://localhost?testvar=test';
        $CurlFactory = new CurlFactory();
        $Curl = $CurlFactory->build('Curl', array($url, $optionList));
        $actual = $Curl->execute();
        $this->assertEquals('test', $actual);
    }
}
