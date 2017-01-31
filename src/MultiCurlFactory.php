<?php

namespace CRTX\Curl;

use CRTX\AbstractFactory\AbstractFactory;

class MultiCurlFactory extends AbstractFactory
{
    public function build($string, array $arguments = array())
    {
        $this->ReflectedClass = new \ReflectionClass($this->namespace . "\\" . $string);
        $MultiCurl = $this->ReflectedClass->newInstanceArgs(array());
        foreach($arguments as $Curl) {
            $MultiCurl->add($Curl);
        }

        return $MultiCurl;
    }
}
