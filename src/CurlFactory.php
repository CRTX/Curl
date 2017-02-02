<?php

namespace CRTX\Curl;

use CRTX\AbstractFactory\AbstractFactory;

class CurlFactory extends AbstractFactory
{
    public function build($string, array $arguments = array())
    {
        $this->ReflectedClass = new \ReflectionClass($this->namespace . "\\" . $string);

        if (is_string($arguments[0])) {
            $arguments[0] = curl_init($arguments[0]);
        }

        return $this->ReflectedClass->newInstanceArgs(array(
                $arguments[0],
                $arguments[1]
            )
        );
    }
}
