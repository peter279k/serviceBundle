<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Client;

class Google extends Service
{
    public function sendReq()
    {
        $apiURL = 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->config['apiKey'];
        $client = new Client([
                'defaults' => [
                    'headers' => ['Content-Type', 'application/json'],
                ],
            ]);
        $res = $client->post($apiURL, [
                'json' => [
                    'longUrl' => $this->config['longUrl']
                ],
            ]);

        return json_decode($res->getBody(), true);
    }
}
