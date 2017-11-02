<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class McAfee implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function sendReq()
    {
        $url = 'http://mcaf.ee/api/shorten?input_url='.$this->config['longUrl'];
        $client = new \GuzzleHttp\Client();
        return $client->get($url)->json();
    }
}