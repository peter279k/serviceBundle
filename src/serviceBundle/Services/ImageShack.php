<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Client;

class ImageShack extends Service
{
    public function sendReq()
    {
        $filePath = $this->config['filePath'];

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException('file not found');
        }

        $postBody = [
            'fileupload' => fopen($imageFilePath, 'r'),
            'key' => $this -> configs['key'],
            "format" => 'json',
            'max_file_size' => $this -> configs['maxFileSize'],
            'Content-type' => 'multipart/form-data'
        ];

        $httpClient = new Client();
        $res = $httpClient->post('http://imageshack.us/upload_api.php', [
                'form_params' => $postBody,
            ]);

        return json_decode($res->getBody(), true);
    }
}
