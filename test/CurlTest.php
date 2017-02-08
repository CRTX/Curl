<?php

/*
 * This file is part of the CRTX\Curl package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CRTX\Curl\Test;

use CRTX\Curl\Curl;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

/**
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
class CurlTest extends PHPUnit_Framework_TestCase
{
    protected $testURL = 'http://localhost?testvar=test';

    public function testCurl()
    {
        $curlHandle = curl_init($this->testURL);
        $Curl = new Curl($curlHandle, $this->getDefaultOptionList());
        $actual = $Curl->execute();
        $this->assertEquals('test', $actual);
    }

    public function testCurlClose()
    {
        $curlHandle = curl_init($this->testURL);
        $Curl = new Curl($curlHandle);
        $Curl = null;
        $this->assertFalse(is_resource($curlHandle));
    }

    public function testCurlError()
    {
        $curlHandle = curl_init('http://invalidHost');
        $Curl = new Curl($curlHandle);
        $actual = $Curl->execute();
        $this->assertTrue(!empty($Curl->getError()));
    }
    
    public function testInvalidCurlHandle()
    {
        try {
            $Curl = new Curl(null, []);
            $Curl->execute();
        } catch (InvalidArgumentException $e) {
            $throwed = true;
        }
        $this->assertTrue($throwed);
    }

    protected function getDefaultOptionList()
    {
        $optionList = array(
            CURLOPT_RETURNTRANSFER => true
        );

        return $optionList;
    }
}
