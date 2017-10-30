<?php

namespace peter\components\serviceBundle;

class McAfee implements Service
{
    public function sendReq()
    {
        $url = 'http://mcaf.ee/api/shorten?input_url=' . $this->configs['longUrl'];
        $client = new \GuzzleHttp\Client();
        return $client->get($url)->json();
    }
}
