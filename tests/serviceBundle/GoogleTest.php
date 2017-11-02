<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class GoogleTest extends TestCase
{
    /** @test */
    public function isTypeOfBitly()
    {
        $googleService = (new ServiceFactory)->create('google');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\Google::class, $googleService);
    }

    /** @test */
    public function canSendReq()
    {
        $config = [
            'apiKey' => 'AIzaSyDZejNxp_e-AKPWujI_cNBTpg2lAC4GBxU',
            'longUrl' => 'https://google.com.tw',
        ];

        $googleService = (new ServiceFactory)->create('google');
        $googleService->setConfig($config);
        $response = $googleService->sendReq();

        $this->assertSame(0, (int) strpos($response['id'], 'http://goo.gl/'));
    }
}