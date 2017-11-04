<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class Mailgun implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function sendReq()
    {
        $res = null;
        $httpConfig = ['defaults' => [
            'auth' => [
                    'api', $this->config['api-key']
                ]
            ]
        ];

        $httpClient = new \GuzzleHttp\Client($httpConfig);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('https://api.mailgun.net/v3/'.$this->config['domain-name'].'/messages', [
                'body' => [
                    'from' => $this->config['from'],
                    'to' => $this->config['to'],
                    'subject' => $this->config['subject'],
                    'text' => $this->config['contents']
                ]
            ]);

        return $res->json();
    }
}
