<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;
use GuzzleHttp\Client;

class Bitly extends Service
{
    public function sendReq()
    {
        $url = 'http://api.bit.ly/v3/shorten?login='.$this->config['login'].'&apiKey='.$this->config['apiKey'].'&uri='.urlencode($this->config['longUrl']);
        $client = new Client();
        $res = $client->get($url);

        return json_decode($res->getBody(), true);
    }
}
