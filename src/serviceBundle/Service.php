<?php 

namespace peter\components\serviceBundle;

abstract class Service
{
    protected $config;

    public function setConfig($config) {
        $this->config = $config;
    }

    abstract public function sendReq();
}
