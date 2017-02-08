<?php

/*
 * This file is part of the CRTX\Curl package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CRTX\Curl;

use InvalidArgumentException;

/**
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
class Curl implements CurlInterface
{
    protected $curlHandle;
    protected $optionList;

    public function __construct($curlHandle, Array $optionList = array())
    {
        $this->curlHandle = $curlHandle;
        $this->setOptions($optionList);
    }

    public function execute() : String
    {
        $this->resourceCheck($this->curlHandle);
        $result = curl_exec($this->curlHandle);

        if(!is_string($result)) {
            return '';
        }

        return $result;
    }

    public function getError() : String
    {
        $errorNumber = curl_errno($this->curlHandle);
        $message = curl_error($this->curlHandle);
        return "cURL error $errorNumber: " . PHP_EOL . $message;
    }

    protected function setOptions(Array $optionList) : void
    {
        foreach($optionList as $optionName => $optionValue) {
            curl_setopt($this->curlHandle, $optionName, $optionValue);
        }
    }

    protected function resourceCheck($value) : void
    {
        if (!is_resource($value)) {
            throw new InvalidArgumentException('Object Curl expects a curl_init(). Incorrect argument provided.');
        }
    }

    public function __destruct()
    {
        if(is_resource($this->curlHandle)) {
            curl_close($this->curlHandle);
        }
    }
}
