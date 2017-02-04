<?php

namespace CRTX\Curl\Test;

use CRTX\Curl\MultiCurlFactory;
use PHPUnit_Framework_TestCase;

class MultiCurlTest extends PHPUnit_Framework_TestCase
{
    public function testMultiCurl()
    {
        $option = array(CURLOPT_RETURNTRANSFER => true);

        $parameterList = array(
            array(
                'url' => 'http://localhost?testvar=test1',
                'optionList' => $option
            ),
            array(
                'url' => 'http://localhost?testvar=test2',
                'optionList' => $option
            )
        );

        $MultiCurlFactory = new MultiCurlFactory();

        $MultiCurl = $MultiCurlFactory->build(
            'MultiCurl',
            $parameterList
        );

        $actual = $MultiCurl->execute();

        $expected = array('test1', 'test2');

        $this->assertEquals(
            $expected,
            $actual,
            "\$canonicalize = true",
            $delta = 0.0,
            $maxDepth = 10,
            $canonicalize = true
        );
    }
}
