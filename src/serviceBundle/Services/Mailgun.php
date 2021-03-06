<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Client;

class Mailgun extends Service
{
    public function sendReq()
    {
        $res = null;

        $httpClient = new Client();
        $res = $httpClient->request('POST', 'https://api.mailgun.net/v3/'.$this->config['domain-name'].'/messages', [
                'form_params'=>[
                    'from' => $this->config["from"],
                    'to' => $this->config["to"],
                    'subject' => $this->config["subject"],
                    'text' => $this->config["contents"]
                ],
                'auth' => ['api', $this->config["api-key"]]
            ]);

        return json_decode($res->getBody(), true);
    }
}
