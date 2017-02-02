<?php

namespace CRTX\Curl;

class Curl implements CurlInterface
{
    protected $curlHandle;
    protected $optionList;

    public function __construct($curlHandle, Array $optionList = array())
    {
        $this->curlHandle = $curlHandle;
        $this->setOptions($optionList);
    }

    public function execute()
    {
        return curl_exec($this->curlHandle);
    }

    protected function setOptions(Array $optionList)
    {
        foreach($optionList as $optionName => $optionValue) {
            curl_setopt($this->curlHandle, $optionName, $optionValue);
        }
    }

    public function __destruct()
    {
        if(is_resource($this->curlHandle)) {
            curl_close($this->curlHandle);
        }
    }
}
