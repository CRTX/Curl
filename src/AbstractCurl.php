<?php

namespace CRTX\Curl;

abstract class AbstractCurl
{
    protected function setOptions(Curl & $Curl)
    {
        foreach($Curl->getOptionList() as $optionName => $optionValue) {
            curl_setopt($Curl->getCurlHandle(), $optionName, $optionValue);
        }
    }
}
