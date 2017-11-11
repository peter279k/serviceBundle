<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\McAfee;

class McAfeeTest extends TestCase
{
    public function testIsTypeOfMcAfee()
    {
        $mcafeeService = (new ServiceFactory)->create('McAfee');
        $this->assertInstanceOf(McAfee::class, $mcafeeService);
    }

    public function testCanShortenUrl()
    {
        $config = [
            'longUrl' => 'https://google.com.tw'
        ];

        $mcafeeService = (new ServiceFactory)->create('McAfee');
        $mcafeeService->setConfig($config);
        $response = $mcafeeService->sendReq();

        $this->assertSame(200, (int) $response['status_code']);
        $this->assertSame(0, (int) strpos($response['data']['url'], 'http://mcaf.ee/'));
    }
}
