<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use \Mailjet\Resources;

class Mailjet extends Service
{
    public function sendReq()
    {
        $mailjet = new \Mailjet\Client($this->config['api-key-public'], $this->config['api-key-private'], true, ['version' => 'v3.1']);
        $body = ['Messages' => [
            ['From' => [
                'Email' => $this->config['from-email'],
                'Name' => $this->config['from-name']
            ],'To' => [[
                'Email' => $this->config['to-email'],
                'Name' => $this->config['to-name']
                ]],
                'Subject' => $this->config['subject'],
                'TextPart' => $this->config['contents']
        ]]];

        $response = $mailjet->post(Resources::$Email, ['body' => $body]);

        return $response->getBody();
    }
}
