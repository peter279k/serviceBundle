<?php

namespace peter\components\serviceBundle;

class McAfee implements Service
{
    $name = 'McAfee';

    public function sendReq()
    {
        $apiURL = 'http://mcaf.ee/api/shorten?input_url=' . $this->configs['longUrl'];
        $client = new \GuzzleHttp\Client();
        return $client->get($apiURL)->json();
    }

    public function getName()
    {
        return $this->name;
    }
}
