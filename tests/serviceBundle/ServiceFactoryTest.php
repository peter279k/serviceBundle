<?php

use PHPUnit\Framework\TestCase;
use peter\components\serviceBundle\ServiceFactory;

class ServiceFactoryTest extends TestCase
{
    /** @test */
    public function throwsExceptionWhenServiceIsNotFound()
    {
        try {
            $badService = (new ServiceFactory)->create('bad');
        } catch(Exception $e) {
            $this->assertSame('Service does not exist', $e->getMessage());
        }
    }
}
