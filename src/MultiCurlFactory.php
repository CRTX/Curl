<?php

/*
 * This file is part of the CRTX\Curl package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CRTX\Curl;

use CRTX\AbstractFactory\AbstractFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
class MultiCurlFactory extends AbstractFactory
{
    public function build($className, array $arguments = array())
    {
        $ReflectedClass = $this->getClassReflection($className);

        $parameterBagList = array();

        $CurlFactory = new CurlFactory();

        foreach($arguments as & $parameterList) {
            $parameterList['curlhandle'] = curl_init($parameterList['url']);
            $parameterList['curl'] = $CurlFactory->build('Curl', array(
                    $parameterList['curlhandle'],
                    $parameterList['optionList']
                )
            );
            array_push($parameterBagList, new ParameterBag($parameterList));
        }

        return $ReflectedClass->newInstance($parameterBagList);
    }
}
