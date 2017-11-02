<?php

namespace peter\components\serviceBundle;

use peter\components\serviceBundle\Services\Mailgun;
use peter\components\serviceBundle\Services\Imgur;
use peter\components\serviceBundle\Services\ImageShack;

class ServiceFactory
{
    public function create($service) 
    {
        switch ($service) {
                case 'mailgun':
                    return new Mailgun();
                    break;
                case 'imgur':
                    return new Imgur();
                    break;
                case 'imageshack':
                    return new ImageShack();
                    break;
                default:
                    throw new \Exception('Service does not exist.');
        }
        // if(class_exists($service)) {
        //     return new $service();
        // } 
        // throw new \Exception('Service does not exist.');
    }
}
