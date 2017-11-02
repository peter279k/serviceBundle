<?php

namespace peter\components\serviceBundle\Services;

class Mailgun implements Service
{
    private $configs;

    public function setConfigs($configs)
    {
        $this->configs = $configs;
    }

    public function sendReq()
    {
        $res = null;
        $httpConfig = ['defaults' => [
            'auth' => [
                    'api', $this->configs['api-key']
                ]
            ]
        ];

        $httpClient = new \GuzzleHttp\Client($httpConfig);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('https://api.mailgun.net/v3/'.$this->configs['domain-name'].'/messages', [
                'body' => [
                    'from' => $this->configs['from'],
                    'to' => $this->configs['to'],
                    'subject' => $this->configs['subject'],
                    'text' => $this->configs['contents'],
                ]
            ]);

        return $res->json();
    }
}