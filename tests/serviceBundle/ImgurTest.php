<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\Imgur;

class ImgurTest extends TestCase
{
    public function testIsTypeOfImgur()
    {
        $imgurService = (new ServiceFactory)->create('Imgur');
        $this->assertInstanceOf(Imgur::class, $imgurService);
    }

    public function testThrowsExceptionWhenFileIsNotFound()
    {
        $this->expectException(\InvalidArgumentException::class);

        $config = [
            'clientID' => '3aa5c24753e1656',
            'filePath' => './image123.png',
        ];

        $imgurService = (new ServiceFactory)->create('Imgur');
        $imgurService->setConfig($config);
        $response = $imgurService->sendReq();
    }

    public function testCanSendReq()
    {
        $imgurService = $this->getMockBuilder('peter\components\serviceBundle\Services\Imgur')->getMock();
        $imgurService->method('sendReq')->willReturn([
            'success' => true,
            'status' => 200,
        ]);

        $path = __DIR__.'/image.PNG';

        $config = [
            'clientID' => 'imagur_client_id',
            'filePath' => $path
        ];

        $imgurService->setConfig($config);
        $response = $imgurService->sendReq();

        $this->assertTrue($response['success']);
        $this->assertSame(200, $response['status']);
    }
}
