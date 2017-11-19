# serviceBundle
[![Build Status](https://travis-ci.org/peter279k/serviceBundle.svg?branch=v1.2.8)](https://travis-ci.org/peter279k/serviceBundle) [![Latest Stable Version](https://poser.pugx.org/lee/service-bundle/version)](https://packagist.org/packages/lee/service-bundle) [![Total Downloads](https://poser.pugx.org/lee/service-bundle/downloads)](https://packagist.org/packages/lee/service-bundle) [![Latest Unstable Version](https://poser.pugx.org/lee/service-bundle/v/unstable)](https://packagist.org/packages/lee/service-bundle) [![License](https://poser.pugx.org/lee/service-bundle/license)](https://packagist.org/packages/lee/service-bundle) [![codecov](https://codecov.io/gh/peter279k/serviceBundle/branch/master/graph/badge.svg)](https://codecov.io/gh/peter279k/serviceBundle)
[![Gitter](https://badges.gitter.im/peter279k/serviceBundle.svg)](https://gitter.im/peter279k/serviceBundle?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f29371ba-ab1c-4203-84d3-7c903e919824/big.png)](https://insight.sensiolabs.com/projects/f29371ba-ab1c-4203-84d3-7c903e919824)

Integrating with mailing service, uploading image service and so on.

It's based on [Guzzle](https://github.com/guzzle/guzzle),HTTP client.

## Following service table is about supporting status

| service-name|support|service-type|
|-------------|-------|------------|
| [mailgun](https://www.mailgun.com/)| Yes   | mailing service |
| [mailjet](http://dev.mailjet.com/guides/?php#about-the-mailjet-restful-api) | No | mailing service |
| [sendgrid](https://sendgrid.com/)    | Yes    | mailing service |
| [Imgur](http://imgur.com/)       | Yes   | uploading images service |
| [Imageshack](https://www.imageshack.us)       | Yes   | uploading images service |
| [bit.ly](https://bitly.com/)      | Yes    | shorten url service |
| [goo.gl](https://goo.gl/)      | Yes    | shorten url service |
|[McAf.ee](https://community.mcafee.com/docs/DOC-1991)| Yes | shorten url service |

## Usage
### Install Package

  We strongly recommended using [composer](https://getcomposer.org)

  Getting composer
  ```bash
  curl -sS https://getcomposer.org/installer | php
  ```
  Using this command
  ```bash
  php composer.phar require lee/service-bundle
  ```
## Sample code
  Mailgun: a sending mail service
  ```php
  require 'vendor/autoload.php';
  $config = [
      'service-name' => 'Mailgun',
      //e.g. key-98dXXXXXXX
      'api-key' => 'mailgun-api-key',
      //e.g. sandbox5099cXXXXXXXXXXXXXXXXXXX
      'domain-name' => 'mailgun-domain-name',
      'from' => 'peter279k@gmail.com',
      'to' => 'peter279k@gmail.com',
      'subject' => 'Hello',
      //contents supported only plain text now.
      'contents' => 'Mailgun is awesome !'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (mailgun standard api response via cURL)
  var_dump($bundle->sendReq());
  ```
  Imgur: an uploading images service
  ```php
  require 'vendor/autoload.php';
  $config = [
		'service-name' => 'Imgur',
		'clientID' => 'imgur-client-id',
		'filePath' => '/path/to/image.png'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (Imgur standard api response via cURL)
  var_dump($bundle -> sendReq());
  ```

  ImageShack: an uploading images service
  ```php
  require 'vendor/autoload.php';
  $config = [
		'service-name' => 'ImageShack',
		'key' => 'your-Imageshack-api-key',
		//specify the image max file size
		'maxFileSize' => '5242880'
		'filePath' => '/path/to/image.png'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (Imgur standard api response via cURL)
  var_dump($bundle -> sendReq());
  ```

  McAfee: a shorten url service
  ```php
  require 'vendor/autoload.php';
  $config = [
		'service-name' => 'McAfee',
		'longUrl' => 'your-long-url'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (McAf standard api response via cURL)
  var_dump($bundle->sendReq());
  ```
  Google shorten url service: a shorten url service
  ```php
  require 'vendor/autoload.php';
  $config = [
		'service-name' => 'Google',
		'apiKey' => 'your-api-key',
		'longUrl' => 'your-long-url'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (goo.gl standard api response via cURL)
  var_dump($bundle->sendReq());
  ```
  Bitly: a shorten url service
  ```php
  require 'vendor/autoload.php';
  $config = [
		'service-name' => 'Bitly',
		'login' => 'your-login',
		'apiKey' => 'your-api-key',
		'longUrl' => 'your-long-url'
  ];
  $bundle = new \peter\components\serviceBundle\ServiceBundle($config);
  //return json format (bit.ly standard api response via cURL)
  var_dump($bundle -> sendReq());
  ```
## Run TestCase
  ```
  composer test
  ```

### Changelog

#### 2016/07/20
+ version: v1.2.7
+ Using the new version of Guzzle 5 and avoid the Httpoxy vulnerability.

#### 2016/07/21
+ version: v1.2.8
+ Fix the uploading image via imgur service bug.

#### 2016/07/21
+ version: v1.2.9
+ adding some information images

#### 2016/07/21
+ version: v1.3.1
+ supporting the Imageshack API

#### 2017/11/11
+ version: v1.4.0
+ Change the namespace and see the sample code to know this.
+ Change the source code(code refactoring)
+ Using the PHPUnit ```Mock``` to test the HTTP API requests.
+ The version 2.x is deprecated.
+ Update the Guzzle version to 6.2
+ Change the ```service-name``` value in ```$config``` array.


## Version Guidance

| Version | Status      | Packagist           | Namespace    | PSR-7 |
|---------|-------------|---------------------|--------------|-------|
| 1.x     | Maintained  | `lee/service-bundle` | `peter\components\serviceBundle` | No    |
| 2.x     | **Deprecated      | `lee/service-bundle` | `peter\components\ServiceBundle` | No    |

[serviceBundle-1-repo](https://github.com/peter279k/serviceBundle/tree/master)

[serviceBundle-2-repo(deprecated)](https://github.com/peter279k/serviceBundle/tree/guzzle6)
