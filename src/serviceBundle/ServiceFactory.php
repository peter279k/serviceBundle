<?php

namespace peter\components\serviceBundle;

use peter\components\serviceBundle\Exceptions\UnknownServiceNameException;

class ServiceFactory
{
    public static function create($service)
    {
        $service = '\peter\components\serviceBundle\Services\/'.$service;
        $service = str_replace('/', '', $service);
        if (class_exists($service)) {
            return new $service();
        }

        throw new UnknownServiceNameException('The Service name does not existed');
    }
}
