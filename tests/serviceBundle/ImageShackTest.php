<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\ImageShack;

class ImageShackTest extends TestCase
{
    public function testIsTypeOfImageShack()
    {
        $imgurService = (new ServiceFactory)->create('ImageShack');
        $this->assertInstanceOf(ImageShack::class, $imgurService);
    }

    public function testThrowsExceptionWhenFileIsNotFound()
    {
        $this->expectException(\InvalidArgumentException::class);

        $config = [
            'key' => 'imageshack_api_key',
            'maxFileSize' => '5242880',
            'filePath' => __DIR__.'/image123.PNG',
        ];

        $imgurService = (new ServiceFactory)->create('ImageShack');
        $imgurService->setConfig($config);
        $response = $imgurService->sendReq();
    }

    public function testCanSendReq()
    {
        $imageShackService = $this->getMockBuilder('peter\components\serviceBundle\Services\ImageShack')->getMock();
        $imageShackService->method('sendReq')->willReturn([
            'status' => true,
            'links' => [
                'image_link' => 'http://imagizer.imageshack.com/short_url_name',
            ],
        ]);

        $path = __DIR__.'/image.PNG';

        $config = [
            'key' => 'imageshack_api_key',
            'maxFileSize' => '5242880',
            'filePath' => $path,
        ];

        $imageShackService->setConfig($config);
        $response = $imageShackService->sendReq();

        $this->assertTrue($response['status']);
        $this->assertSame(0, (int) strpos($response['links']['image_link'], 'http://imagizer.imageshack.com'));
    }
}
