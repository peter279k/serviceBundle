<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class MailgunTest extends TestCase
{
    /** @test */
    public function isTypeOfMailgun()
    {
        $mailgunService = (new ServiceFactory)->create('mailgun');
        $this->assertInstanceOf(peter\components\serviceBundle\Mailgun::class, $mailgunService);
    }

    /** @test */
    public function canSendEmail()
    {
        $fakeResponse = [
            'id' => '<20171031193543.106121.C5D2A970EE25C57B@sandboxeff4a9e74ada4d2fadf041733ba287c3.mailgun.org>',
            'message' => 'Queued. Thank you.'
        ];
        $mailgun = $this->getMockBuilder('peter\components\serviceBundle\Mailgun')
                ->disableOriginalConstructor()
                ->getMock();

        $mailgun->method('sendReq')
            ->willReturn($fakeResponse);

        $configs = [
            'api-key' => 'key-1234567890',
            'domain-name' => 'sandbox1234567890.mailgun.org',
            'from' => 'john.doe@gmail.com',
            'to' => 'john.doe@gmail.com',
            'subject' => 'Hello',
            'contents' => 'Mailgun is awesome !',
        ];

        $mailgunService = (new ServiceFactory)->create('mailgun');
        $mailgunService->setConfigs($configs);
        $response = $mailgunService->sendReq();

        echo '<pre>'; var_dump($response); echo '</pre>'; die();

        $this->assertEquals('Queued. Thank you.', $response['message']);
    }
}