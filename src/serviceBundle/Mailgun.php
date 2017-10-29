<?php

namespace peter\components\serviceBundle;

class Mailgun implements Service
{
    public function sendReq()
    {
        $res = null;
        $httpConfig = ['defaults' => [
            'auth' => [
                    'api', $this->configs['api-key']
                ]
            ]
        ];=

        $httpClient = new \GuzzleHttp\Client($httpConfig);
        $httpClient->setDefaultOption('verify', false);
        $res = $httpClient->post('https://api.mailgun.net/v3/'.$this->configs['domain-name'].'.mailgun.org/messages', [
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