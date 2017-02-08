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
use CRTX\Curl\MultiCurl;
use PHPUnit_Framework_TestCase;

/**
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
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
