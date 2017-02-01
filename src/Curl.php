<?php

namespace CRTX\Curl;

class Curl extends AbstractCurl
{
    protected $curlHandle;
    protected $optionList;

    public function __construct(String $url, Array $optionList = array())
    {
        $this->curlHandle = curl_init($url);
        $this->setOptions($optionList);
    }

    public function execute()
    {
        return curl_exec($this->curlHandle);
    }

    public function getCurlHandle()
    {
        return $this->curlHandle;
    }

    public function __destruct()
    {
        if(is_resource($this->curlHandle)) {
            curl_close($this->curlHandle);
        }
    }

    protected function setOptions(Array $optionList)
    {
        foreach($optionList as $optionName => $optionValue) {
            curl_setopt($this->curlHandle, $optionName, $optionValue);
        }
    }
}
