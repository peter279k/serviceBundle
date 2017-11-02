<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class ImageShack implements Service
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

        $postBody = [
            'fileupload' => new \GuzzleHttp\Post\PostFile('fileupload', fopen($filePath, 'r')),
            'key' => $this->config['key'],
            'format' => 'json',
            'max_file_size' => $this->config['maxFileSize'],
            'Content-type' => 'multipart/form-data',
        ];

        $httpClient = new \GuzzleHttp\Client([]);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('http://imageshack.us/upload_api.php', [
                'body' => $postBody,
            ]);

        return $res->json();
    }
}