<?php

namespace CRTX\Curl;

class Curl extends AbstractCurl
{
    protected $curlHandle;
    protected $optionList;

    public function __construct(String $url, Array $optionList = array())
    {
        $this->curlHandle = curl_init($url);
        $this->optionList = $optionList;
    }

    public function execute()
    {
        $this->setOptions();
        return curl_exec($this->curlHandle);
    }

    public function getCurlHandle()
    {
        return $this->curlHandle;
    }

    public function getOptionList()
    {
        return $this->optionList;
    }

    public function __destruct()
    {
        if(is_resource($this->curlHandle)) {
            curl_close($this->curlHandle);
        }
    }

    public function setOptions()
    {
        foreach($this->optionList as $optionName => $optionValue) {
            curl_setopt($this->curlHandle, $optionName, $optionValue);
        }
    }
}
