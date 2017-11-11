<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\Google;

class GoogleTest extends TestCase
{
    public function testIsTypeOfGoogle()
    {
        $googleService = (new ServiceFactory)->create('Google');
        $this->assertInstanceOf(Google::class, $googleService);
    }

    public function testShouldSendReq()
    {
        $googleService = $this->getMockBuilder('peter\components\serviceBundle\Services\Google')->getMock();
        $googleService->method('sendReq')->willReturn([
            'id' => 'http://goo.gl/short_url_name',
        ]);

        $config = [
            'apiKey' => 'google_api_key',
            'longUrl' => 'https://google.com.tw',
        ];

        $googleService->setConfig($config);
        $response = $googleService->sendReq();

        $this->assertSame(0, (int) strpos($response['id'], 'http://goo.gl/'));
    }
}
