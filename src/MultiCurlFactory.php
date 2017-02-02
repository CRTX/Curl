<?php

namespace CRTX\Curl;

use CRTX\AbstractFactory\AbstractFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class MultiCurlFactory extends AbstractFactory
{
    public function build($string, array $arguments = array())
    {
        $this->ReflectedClass = new \ReflectionClass($this->namespace . "\\" . $string);

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

        return $this->ReflectedClass->newInstanceArgs(array(
                $parameterBagList
            )
        );
    }
}
