<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Client;

class McAfee extends Service
{
    public function sendReq()
    {
        $url = 'http://mcaf.ee/api/shorten?input_url='.$this->config['longUrl'];
        $client = new Client();
        $res = $client->get($url);

        return json_decode($res->getBody(), true);
    }
}
