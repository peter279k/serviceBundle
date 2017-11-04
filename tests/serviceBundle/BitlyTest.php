<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class BitlyTest extends TestCase
{
    /** @test */
    public function isTypeOfBitly()
    {
        $bitlyService = (new ServiceFactory)->create(Bitly::class);
        $this->assertInstanceOf(peter\components\serviceBundle\Services\Bitly::class, $bitlyService);
    }

    /** @test */
    public function canSendReq()
    {
        $config = [
            'login' => 'o_2tl6qii96h',
            'apiKey' => 'R_3bf8524a894244089b999e10701d5e0e',
            'longUrl' => 'https://google.com.tw',
        ];

        $bitlyService = (new ServiceFactory)->create('Bitly');
        $bitlyService->setConfig($config);
        $response = $bitlyService->sendReq();

        $this->assertSame(200, $response['status_code']);
        $this->assertSame(0, (int) strpos($response['data']['url'], 'http://bit.ly/'));
    }
}
