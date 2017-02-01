[![Build Status](https://travis-ci.org/CRTX/Curl.svg?branch=master)](https://travis-ci.org/CRTX/Curl)

The main purpose of this cURL wrapper is to be able to mock cURL calls in php unit tests.

It is cumbersome to mock native php ```curl_*``` functions to replace in unit tests.

Having objects instead of native functions makes life easier when unit testing.

#Usage


##Curl

```php
use CRTX\Curl\Curl;

//Curl option values from http://php.net/manual/en/function.curl-setopt.php
$optionList = array(
    CURLOPT_RETURNTRANSFER => true
);

$Curl = new Curl('http://localhost?testvar=test', $optionList);

//$result will contain the page's HTML
$result = $Curl->execute();
```

##MultiCurl

```php
use CRTX\Curl\Curl;
use CRTX\Curl\MultiCurl;

$optionList = array(
    CURLOPT_RETURNTRANSFER => true
);

$Curl1 = new Curl('http://localhost?testvar=test1', $optionList);
$Curl2 = new Curl('http://localhost?testvar=test2', $optionList);

$MultiCurl = new MultiCurl(array($Curl1, $Curl2));
//If CURLOPT_RETURNTRANSFER is true $result will return an array with the HTML of all the pages
$result = $MultiCurl->execute();

```

###Adding extra URLs to existing MultiCurl object.

It is as simple as calling:

```php
$MultiCurl->add(new Curl(...));
```
