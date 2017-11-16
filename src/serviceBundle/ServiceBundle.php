<?php

namespace peter\components\serviceBundle;

class ServiceBundle
{
    private $configs = [];

    public function __construct(array $config)
    {
        $this->configs = $config;
    }

    public function sendReq()
    {
        $factory = ServiceFactory::create($this->configs['service-name']);
        $factory->setConfig($this->configs);

        return $factory->sendReq();
    }
}
