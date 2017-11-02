<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class ImgurTest extends TestCase
{
    /** @test */
    public function isTypeOfImgur()
    {
        $imgurService = (new ServiceFactory)->create('imgur');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\Imgur::class, $imgurService);
    }

    /** @test */
    public function throwsExceptionWhenFileIsNotFound()
    {
       $path = __DIR__.'/image.PNG';
        $os = PHP_OS;

        if ($os == 'WINNT') {
            $path = str_replace('\\', '\\\\', __DIR__);
            $path .= '\\image.PNG';
        }

        $config = [
            'service-name' => 'imgur',
            'clientID' => '3aa5c24753e1656',
            'filePath' => './image123.png',
        ];

        try {
            $imgurService = (new ServiceFactory)->create('imgur');
            $imgurService->setConfig($config);
            $response = $imgurService->sendReq();
        } catch(Exception $e) {
            $this->assertSame('file not found', $e->getMessage());
        }
    }

    /** @test */
    public function canSendReq()
    {
       $path = __DIR__.'/image.PNG';
        $os = PHP_OS;

        if ($os == 'WINNT') {
            $path = str_replace('\\', '\\\\', __DIR__);
            $path .= '\\image.PNG';
        }

        $config = [
            'clientID' => '3aa5c24753e1656',
            'filePath' => $path
        ];

        $imgurService = (new ServiceFactory)->create('imgur');
        $imgurService->setConfig($config);
        $response = $imgurService->sendReq();

        $this->assertSame(true, $response['success']);
        $this->assertSame(200, $response['status']);
    }
}