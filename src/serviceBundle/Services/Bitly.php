<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class Bitly implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function sendReq()
    {
        $url = 'http://api.bit.ly/v3/shorten?login='.$this->config['login'].'&apiKey='.$this->config['apiKey'].'&uri='.urlencode($this->config['longUrl']);
        $client = new \GuzzleHttp\Client();
        return $client->get($url)->json();
    }
}