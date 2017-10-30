<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceBundle\Mailgun;

class MailgunTest extends TestCase
{
    /** @test */
    public function testIsTypeOfMailgun()
    {
        $mailgunService = ServiceFactory::create('mailgun');
    }
}