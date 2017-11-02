<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class McAfeeTest extends TestCase
{
    /** @test */
    public function isTypeOfMcAfee()
    {
        $mcafeeService = (new ServiceFactory)->create('mcafee');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\McAfee::class, $mcafeeService);
    }

    /** @test */
    public function canSendEmail()
    {
        $config = [
            'longUrl' => 'https://google.com.tw'
        ];

        $mcafeeService = (new ServiceFactory)->create('mcafee');
        $mcafeeService->setConfig($config);
        $response = $mcafeeService->sendReq();

        $this->assertSame(200, (int) $response['status_code']);
        $this->assertSame(0, (int) strpos($response['data']['url'], 'http://mcaf.ee/'));
    }
}