<?php

namespace CRTX\Curl;

use CRTX\AbstractFactory\AbstractFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

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
