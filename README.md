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

$curlHandle = curl_init('http://localhost?testvar=test');

$Curl = new Curl($curlHandle, $optionList);

//$result will contain the page's HTML
$result = $Curl->execute();
```

Note that this library doesn't yet support the full features of ```curl_*``` functions.

To use all the features, you may use the ```$curlHandle``` to manipulate it before calling ````new Curl($curlHandle, ...```

Calling ```new Curl($curlHandle,...``` alone will close the curl resource for you automatically when the object is destroyed by PHP's garbage collector.

Even when you call ```curl_init``` outside the class just like the code above the Curl object will take care of closing ```curl_init``` for you.

##Curl Factory

If you like unit testing as much as I do I recommend you use the Curl Factory instead.

```php
use CRTX\Curl\CurlFactory;

$optionList = array(
    CURLOPT_RETURNTRANSFER => true
);

$curlHandle = curl_init('http://localhost?testvar=test');

$CurlFactory = new CurlFactory();
$Curl = $CurlFactory->build('Curl', array($curlHandle, $optionList));
$result = $Curl->execute();
```

##MultiCurl

```php
use CRTX\Curl\MultiCurlFactory;

//If CURLOPT_RETURNTRANSFER is true $result will return an array with the HTML of all the pages
$option = array(CURLOPT_RETURNTRANSFER => true);

$parameterList = array(
    array(
        'url' => 'http://localhost?testvar=test1',
        'optionList' => $option
    ),
    array(
        'url' => 'http://localhost?testvar=test2',
        'optionList' => $option
    )
);

$MultiCurlFactory = new MultiCurlFactory();

$MultiCurl = $MultiCurlFactory->build('MultiCurl', $parameterList);

$result = $MultiCurl->execute();

```

It's very easy to use MultiCurl!

Last but not least, if you'd like to see this library cover a feature please open an issue and or send a pull request.
