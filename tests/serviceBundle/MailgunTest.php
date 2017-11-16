<?php

namespace peter\components\serviceBundle\Test;

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\Services\MailGun;

class MailgunTest extends TestCase
{
    public function testIsTypeOfMailgun()
    {
        $mailgunService = (new ServiceFactory)->create('Mailgun');
        $this->assertInstanceOf(Mailgun::class, $mailgunService);
    }

    public function testCanSendEmail()
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
