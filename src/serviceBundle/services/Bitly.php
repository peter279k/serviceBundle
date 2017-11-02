<?php

namespace peter\components\serviceBundle\Services;

class Bitly implements Service
{
    public function sendReq()
    {
        $url = 'http://api.bit.ly/v3/shorten?login=' . $this->configs['login'] . '&apiKey=' . $this->configs['apiKey'] . '&uri=' . urlencode($this->configs['longUrl']);
        $client = new \GuzzleHttp\Client();
        return $client->get($url)->json();
    }
}