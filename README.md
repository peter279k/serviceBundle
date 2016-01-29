# serviceBundle
Intergated with mailing service,uploading image service and so on.

## Following service table about supporting status

| service-name|support|
|-------------|-------|
| [mailgun](https://www.mailgun.com/)| Yes   |
| [mailjet](http://dev.mailjet.com/guides/?php#about-the-mailjet-restful-api) | No |
| [sendgrid](https://sendgrid.com/)    | No    |
| [Imgur](http://imgur.com/)       | Yes   |
| [bit.ly](https://bitly.com/)      | No    |
| [goo.gl](https://goo.gl/)      | No    |

## Usage
  Install Package
  We strongly recommended using [composer](https://getcomposer.org)
  Using composer
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
  );
  $bundle = new peter\components\serviceBundle($config);
  //return json format (mailgun standard api response)
  var_dump($bundle -> sendReq());
  ```
