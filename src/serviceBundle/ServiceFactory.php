<?php

namespace peter\components\serviceBundle;

class ServiceFactory
{
    public function create($service)
    {
        $service = 'peter\components\serviceBundle\Services\\'.$service;
        if (class_exists($service)) {
            return new $service();
        }

        throw new \Exception('Service does not exist');
    }
}
