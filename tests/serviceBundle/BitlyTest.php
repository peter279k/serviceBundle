<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\Bitly;

class BitlyTest extends TestCase
{
    public function testIsTypeOfBitly()
    {
        $bitlyService = (new ServiceFactory)->create('Bitly');
        $this->assertInstanceOf(Bitly::class, $bitlyService);
    }

    public function testShouldSendReq()
    {
        $bitlyService = $this->getMockBuilder('peter\components\serviceBundle\Services\Bitly')->getMock();
        $bitlyService->method('sendReq')->willReturn([
            'status_code' => 200,
            'data' => [
                'url' => 'http://bit.ly/short_url_name'
            ]
        ]);

        $config = [
            'login' => 'o_api_key',
            'apiKey' => 'R_bitly_key',
            'longUrl' => 'https://google.com.tw',
        ];

        $bitlyService->setConfig($config);
        $response = $bitlyService->sendReq();

        $this->assertSame(200, $response['status_code']);
        $this->assertSame(0, (int) strpos($response['data']['url'], 'http://bit.ly/'));
    }
}
