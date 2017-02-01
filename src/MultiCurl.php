<?php

namespace CRTX\Curl;

class MultiCurl extends AbstractCurl
{
    protected $multiCurlHandle;
    protected $curlCollection;

    public function __construct(Array $curlCollection)
    {
        $this->curlCollection = $curlCollection;
    }

    public function add(Curl $Curl)
    {
        array_push($this->curlCollection, $Curl);
    }

    public function execute(array $optionList = array())
    {
        $this->multiCurlHandle = curl_multi_init();

        $this->addHandleList($this->curlCollection);

        $running = null;

        do {
            curl_multi_exec($this->multiCurlHandle, $running);
        } while ($running);

        $this->removeHandleList($this->curlCollection);

        return $this->getResultList($this->curlCollection);
    }

    protected function addHandleList(Array $curlCollection = array())
    {
        foreach($curlCollection as $Curl) {
            curl_multi_add_handle(
                $this->multiCurlHandle,
                $Curl->getCurlHandle()
            );
        }
    }

    protected function removeHandleList(Array $curlCollection = array())
    {
        foreach($curlCollection as $Curl) {
            curl_multi_remove_handle(
                $this->multiCurlHandle,
                $Curl->getCurlHandle()
            );
        }
    }

    protected function getResultList(array & $curlCollection = array())
    {
        $resultList = array();
        foreach($curlCollection as $Curl) {
            array_push($resultList, curl_multi_getcontent($Curl->getCurlHandle()));
        }
        return $resultList;
    }

    public function __destruct()
    {
        if(is_resource($this->multiCurlHandle)) {
            curl_multi_close($this->multiCurlHandle);
        }
    }
}
