<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class Imgur implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    public function sendReq()
    {
        $filePath = $this->config['filePath'];
        if (!file_exists($filePath)) {
            throw new \Exception('file not found');
        }

        $imageFile = file_get_contents($filePath);
        $httpConfig = ['defaults' => [
                    'headers' => ['Authorization' => 'Client-ID '.$this->config['clientID']],
                ],
            ];

        $httpClient = new \GuzzleHttp\Client($httpConfig);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('https://api.imgur.com/3/image.json', [
                'body' => ['image' => base64_encode($imageFile)]
            ]);

        return $res->json();
    }
}
