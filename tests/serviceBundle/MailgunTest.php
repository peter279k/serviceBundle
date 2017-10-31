<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;
use peter\components\serviceBundle\ServiceBundle\Mailgun;

class MailgunTest extends TestCase
{
    /** @test */
    public function testIsTypeOfMailgun()
    {
        $mailgunService = (new ServiceFactory)->create('mailgun');

    }
}