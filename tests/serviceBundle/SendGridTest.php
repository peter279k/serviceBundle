<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class SendGridTest extends TestCase
{
    /** @test */
    public function isTypeOfMailgun()
    {
        $sendGridService = (new ServiceFactory)->create('sendgrid');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\SendGrid::class, $sendGridService);
    }

    /** @test */
    public function canSendEmail()
    {
        $sendGridService = $this->getMockBuilder('peter\components\serviceBundle\Services\SendGrid')->getMock();
        $sendGridService->method('sendReq')->willReturn([
            'statusCode' => 202,
            'body' => '',
            'headers'=> []
        ]);

        $config = [
            'api-key' => 'SG.A123455',
            'from-name' => 'John Doe',
            'from-email' => 'john.doe@gmail.com',
            'to-name' => 'John Doe',
            'to-email' => 'john.doe@gmail.com',
            'subject' => 'SendGrid Test',
            'contents' => 'Sendgrid is awesome!',
            'sandbox-mode' => true
        ];

        $sendGridService->setConfig($config);
        $response = $sendGridService->sendReq();

        $this->assertSame($response['statusCode'], 202);
    }
}
