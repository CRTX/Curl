<?php

namespace CRTX\Curl;

class MultiCurl implements CurlInterface
{
    protected $multiCurlHandle;
    protected $parameterBagList;

    public function __construct(Array $parameterBagList)
    {
        $this->parameterBagList = $parameterBagList;
    }

    public function execute(array $optionList = array()) : Array
    {
        $this->multiCurlHandle = curl_multi_init();

        $this->addHandleList($this->parameterBagList);

        $running = null;

        do {
            curl_multi_exec($this->multiCurlHandle, $running);
        } while ($running);

        $this->removeHandleList($this->parameterBagList);

        return $this->getResultList($this->parameterBagList);
    }

    protected function addHandleList(Array $parameterBagList)
    {
        foreach($this->parameterBagList as $ParameterBag) {
            curl_multi_add_handle(
                $this->multiCurlHandle,
                $ParameterBag->get('curlhandle')
            );
        }
    }

    protected function removeHandleList(Array $curlCollection = array())
    {
        foreach($this->parameterBagList as $ParameterBag) {
            curl_multi_remove_handle(
                $this->multiCurlHandle,
                $ParameterBag->get('curlhandle')
            );
        }
    }

    protected function getResultList(array & $curlCollection = array())
    {
        $resultList = array();

        foreach($this->parameterBagList as $ParameterBag) {
            array_push(
                $resultList,
                curl_multi_getcontent($ParameterBag->get('curlhandle'))
            );
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
