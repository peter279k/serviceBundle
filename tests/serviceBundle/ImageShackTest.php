<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class ImageShackTest extends TestCase
{
    /** @test */
    public function isTypeOfImageShack()
    {
        $imgurService = (new ServiceFactory)->create('imageshack');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\ImageShack::class, $imgurService);
    }

    /** @test */
    public function throwsExceptionWhenFileIsNotFound()
    {
      $path = __DIR__.'/image123.PNG';
        $os = PHP_OS;

        if ($os == 'WINNT') {
            $path = str_replace('\\', '\\\\', __DIR__);
            $path .= '\\image.PNG';
        }

        $config = [
            'key' => '0156DGOW6788c018fc5882549c147ce6de6db0e7',
            'maxFileSize' => '5242880',
            'filePath' => $path,
        ];

        try {
            $imageShackService = (new ServiceFactory)->create('imageshack');
            $imageShackService->setConfig($config);
            $response = $imageShackService->sendReq();
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
            'key' => '0156DGOW6788c018fc5882549c147ce6de6db0e7',
            'maxFileSize' => '5242880',
            'filePath' => $path,
        ];

        $imgurService = (new ServiceFactory)->create('imageshack');
        $imgurService->setConfig($config);
        $response = $imgurService->sendReq();

        $this->assertSame(1, (int) $response['status']);
        $this->assertSame(0, (int) strpos($response['links']['image_link'], 'http://imagizer.imageshack.com'));
    }
}