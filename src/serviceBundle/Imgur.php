<?php

namespace peter\components\serviceBundle;

class Imgur implements Service
{
    public function sendReq()
    {
        if (!file_exists($this->configs['filePath'])) {
            throw new Exception('file not found');
        }

        $imageFile = file_get_contents($this->configs['filePath']);
        $httpConfig = ['defaults' => [
                    'headers' => ['Authorization' => 'Client-ID '.$this->configs['clientID']],
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