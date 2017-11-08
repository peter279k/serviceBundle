<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class MailjetTest extends TestCase
{
    /** @test */
    public function isTypeOfMailgun()
    {
        $mailjetService = (new ServiceFactory)->create('mailjet');
        $this->assertInstanceOf(peter\components\serviceBundle\Services\Mailjet::class, $mailjetService);
    }

    /** @test */
    public function canSendEmail()
    {
        $config = [
            'api-key-public' => '1234567890',
            'api-key-private' => '1234567890',
            'from-name' => 'John Doe',
            'from-email' => 'john.doe@gmail.com',
            'to-name' => 'John Doe',
            'to-email' => 'john.doe@gmail.com',
            'subject' => 'Mailjet Test',
            'contents' => 'Mailjet is awesome!',
        ];

        $mailjetService = $this->getMockBuilder('peter\components\serviceBundle\Services\Mailjet')->getMock();
        $mailjetService->method('sendReq')->willReturn($this->getSuccessReponse());

        $mailjetService->setConfig($config);
        $response = $mailjetService->sendReq();

        $this->assertSame($response['Messages'][0]['Status'], 'success');
    }

    /** @test */
    public function getsErrorWhenCredentialsAreInvalid()
    {
        $config = [
            'api-key-public' => '1234567890',
            'api-key-private' => '1234567890',
            'from-name' => 'John Doe',
            'from-email' => 'john.doe@gmail.com',
            'to-name' => 'John Doe',
            'to-email' => 'john.doe@gmail.com',
            'subject' => 'Mailjet Test',
            'contents' => 'Mailjet is awesome!',
        ];

        $mailjetService = $this->getMockBuilder('peter\components\serviceBundle\Services\Mailjet')->getMock();
        $mailjetService->method('sendReq')->willReturn($this->getSuccessReponse());

        $mailjetService->setConfig($config);
        $response = $mailjetService->sendReq();

        $this->assertSame($response['Messages'][0]['Status'], 'success');
    }

    protected function getSuccessReponse()
    {
        return [
            'Messages' => [
                0 => [
                    'Status' => 'success',
                    'CustomID' => '',
                    'To' => [
                        0 => [
                            'Email' => 'john.doe@gmail.com',
                            'MessageUUID' => '34523452-0716-4079-a5f0-3523534523',
                            'MessageID' => 123456677545454545,
                            'MessageHref' => 'https://api.mailjet.com/v3/REST/message/123456677545454545'
                        ]
                    ],
                    'Cc' => [],
                    'Bcc' => []
                ]
            ]
        ];
    }

    protected function getFailureReponse()
    {
        return [
            'ErrorIdentifier' => '26d1af4f-2c3f-4e9a-96f7-60ab32470a13',
            'StatusCode' => 401,
            'ErrorMessage' => 'API key authentication/authorization failure. You may be unauthorized to access the API or your API key may be expired. Visit API keys management section to check your keys.'
        ];
    }
}
