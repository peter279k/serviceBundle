<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceBundle;
use peter\components\serviceBundle\Exceptions\UnknownServiceNameException;

class ServiceBundleTest extends TestCase
{
    public function testInstanceOfServiceBundle()
    {
        $config = [
            'service-name' => 'McAfee',
            'longUrl' => 'https://google.com.tw',
        ];
        $service = new ServiceBundle($config);
        $response = $service->sendReq();
        $this->assertSame(200, (int) $response['status_code']);
    }
}
