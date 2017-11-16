<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Exceptions\UnknownServiceNameException;

class ServiceFactoryTest extends TestCase
{
    public function testThrowsExceptionWhenServiceIsNotFound()
    {
        $this->expectException(UnknownServiceNameException::class);
        $badService = (new ServiceFactory)->create('bad');
    }

    public function testServiceGetConfig()
    {
        $mcafeeService = (new ServiceFactory)->create('McAfee');
        $config = [
            'service-name' => 'McAfee',
            'longUrl' => 'https://google.com.tw',
        ];
        $mcafeeService->setConfig($config);

        $this->assertSame($config['service-name'], $mcafeeService->getConfig()['service-name']);
    }
}
