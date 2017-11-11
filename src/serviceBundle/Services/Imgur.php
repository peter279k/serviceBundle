<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Client;

class Imgur extends Service
{
    public function sendReq()
    {
        $filePath = $this->config['filePath'];
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException('file not found');
        }

        $imageFile = file_get_contents($filePath);
        $httpConfig = ['defaults' => [
                    'headers' => ['Authorization' => 'Client-ID '.$this->config['clientID']],
                ],
            ];

        $httpClient = new Client($httpConfig);
        $res = $httpClient->post('https://api.imgur.com/3/image.json', [
                'body' => ['image' => base64_encode($imageFile)]
            ]);

        return $res->json();
    }
}
