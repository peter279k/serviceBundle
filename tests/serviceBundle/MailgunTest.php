<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class MailgunTest extends TestCase
{
    /** @test */
    public function isTypeOfMailgun()
    {
        $mailgunService = (new ServiceFactory)->create('mailgun');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\Mailgun::class, $mailgunService);
    }

    /** @test */
    public function canSendEmail()
    {
        $mailgunService = $this->getMockBuilder('peter\components\serviceBundle\Services\Mailgun')->getMock();
        $mailgunService->method('sendReq')->willReturn([
            'id' => '<20171031193543.106121.C5D2A970EE25C57B@sandboxeff4a9e74ada4d2fadf041733ba287c3.mailgun.org>',
            'message' => 'Queued. Thank you.'
        ]);

        $config = [
            'api-key' => 'key-1234567890',
            'domain-name' => 'sandbox1234567890.mailgun.org',
            'from' => 'john.doe@gmail.com',
            'to' => 'john.doe@gmail.com',
            'subject' => 'Hello',
            'contents' => 'Mailgun is awesome !',
        ];

        $mailgunService->setConfig($config);
        $response = $mailgunService->sendReq();

        $this->assertSame('Queued. Thank you.', $response['message']);
    }
}
