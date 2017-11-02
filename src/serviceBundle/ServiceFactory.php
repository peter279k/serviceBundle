<?php

namespace peter\components\serviceBundle;

use peter\components\serviceBundle\Services\Mailgun;
use peter\components\serviceBundle\Services\Imgur;
use peter\components\serviceBundle\Services\ImageShack;
use peter\components\serviceBundle\Services\Bitly;
use peter\components\serviceBundle\Services\McAfee;
use peter\components\serviceBundle\Services\Google;

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
                case 'bitly':
                    return new Bitly();
                    break;
                case 'mcafee':
                    return new McAfee();
                    break;
                case 'google':
                    return new Google();
                    break;
                default:
                    throw new \Exception('Service does not exist');
        }
    }
}
