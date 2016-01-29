# serviceBundle
Intergating with mailing service,uploading image service and so on.

It's based on [Guzzle](https://github.com/guzzle/guzzle),HTTP client.

## Following service table is about supporting status

| service-name|support|service-type|
|-------------|-------|------------|
| [mailgun](https://www.mailgun.com/)| Yes   | mailing service |
| [mailjet](http://dev.mailjet.com/guides/?php#about-the-mailjet-restful-api) | No | mailing service |
| [sendgrid](https://sendgrid.com/)    | No    | mailing service |
| [Imgur](http://imgur.com/)       | Yes   | uploading images service |
| [bit.ly](https://bitly.com/)      | No    | shorten url service |
| [goo.gl](https://goo.gl/)      | No    | shorten url service |
|[McAf.ee](https://community.mcafee.com/docs/DOC-1991)| No | shorten url service |

## Usage
  Install Package
  
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
  $config = array(
      'service-name' => 'mailgun',
      //e.g. key-98dXXXXXXX
      'api-key' => 'mailgun-api-key',
      //e.g. sandbox5099cXXXXXXXXXXXXXXXXXXX
      'domain-name' => 'mailgun-domain-name'
      'from' => 'peter279k@gmail.com',
      'to' => 'peter279k@gmail.com',
      'subject' => 'Hello',
      //contents supported only plain text now.
      'contents' => 'Mailgun is awesome !'
  );
  $bundle = new peter\components\serviceBundle($config);
  //return json format (mailgun standard api response via cURL)
  var_dump($bundle -> sendReq());
  ```
  Imgur: an uploading images service
  ```php
  require 'vendor/autoload.php';
  $config = array(
		'service-name' => 'imgur',
		'clientID' => 'imgur-client-id',
		'filePath' => '/path/to/image.png'
  );
  $bundle = new peter\components\serviceBundle($config);
  //return json format (mailgun standard api response via cURL)
  var_dump($bundle -> sendReq());
  ```
