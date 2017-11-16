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

        $httpClient = new Client($httpConfig);

        $res = $httpClient -> request('POST', 'https://api.imgur.com/3/image.json', [
            'form_params' => [
                'image' => base64_encode($imageFile)
            ],
            'headers' => ['Authorization' => 'Client-ID ' . $this->config["clientID"]]
        ]);

        return json_decode($res->getBody(), true);
    }
}
