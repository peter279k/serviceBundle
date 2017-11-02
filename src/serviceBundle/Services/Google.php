<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class Google implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function sendReq()
    {
        $apiURL = 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->config['apiKey'];
        $client = new \GuzzleHttp\Client([
                'defaults' => [
                    'headers' => ['Content-Type', 'application/json'],
                ],
            ]);

        return $client->post($apiURL, [
                'json' => ['longUrl' => $this->config['longUrl']],
            ])->json();
    }
}