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

use CRTX\Curl\MultiCurlFactory;
use PHPUnit_Framework_TestCase;

/**
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
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
