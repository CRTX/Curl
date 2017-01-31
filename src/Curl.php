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

    public function execute(array $optionList = array())
    {
        $this->setOptions($this);
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
}
