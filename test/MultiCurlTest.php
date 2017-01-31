<?php

use CRTX\Curl\Curl;
use CRTX\Curl\CurlFactory;
use CRTX\Curl\MultiCurl;
use CRTX\Curl\MultiCurlFactory;

class MultiCurlTest extends PHPUnit_Framework_TestCase
{
    public function testMultiCurl()
    {
        $urlList = array(
            'http://localhost?testvar=test1',
            'http://localhost?testvar=test2'
        );

        $curlList = array();

        $CurlFactory = new CurlFactory();

        foreach($urlList as $url) {
            array_push($curlList, $CurlFactory->build('Curl',
                    array(
                        $url,
                        array(CURLOPT_RETURNTRANSFER => true)
                    )
                )
            );
        }

        $MultiCurlFactory = new MultiCurlFactory();

        $MultiCurl = $MultiCurlFactory->build('MultiCurl', $curlList);

        $result = $MultiCurl->execute();

        $testArray = array(
            'test1', 'test2'
        );

        $this->assertEquals(
            $testArray,
            $result,
            "\$canonicalize = true",
            $delta = 0.0,
            $maxDepth = 10,
            $canonicalize = true
        );
    }
}
