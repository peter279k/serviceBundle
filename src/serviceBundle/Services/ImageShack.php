<?php

namespace peter\components\serviceBundle\Services;

class ImageShack implements Service
{
    public function sendReq()
    {
        $filePath = $this->configs['filePath'];
        if (!file_exists($filePath)) {
            throw new Exception('file not found';)
        }
        
        $postBody = [
            'fileupload' => new \GuzzleHttp\Post\PostFile('fileupload', fopen($filePath, 'r')),
            'key' => $this->configs['key'],
            'format' => 'json',
            'max_file_size' => $this->configs['maxFileSize'],
            'Content-type' => 'multipart/form-data',
        ];

        $httpClient = new \GuzzleHttp\Client([]);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('http://imageshack.us/upload_api.php', [
                'body' => $postBody,
            ]);

        return $res->json();
    }

    public function getName()
    {
        return $this->name;
    }
}