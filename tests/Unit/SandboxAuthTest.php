<?php

namespace Samerior\MobileMoney\Tests\Unit;


use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use Samerior\MobileMoney\Mpesa\Library\Authenticator;
use Samerior\MobileMoney\Tests\TestCase;

class SandboxAuthTest extends TestCase
{
    /** @test */
    public function it_throws_exception_for_invalid_credentials()
    {
        $this->expectException(MpesaException::class);
        mpesa_request('0799123456', 1, 'test', 'tests');
    }

    /** @test */
    public function it_gets_tokens()
    {
        /** @var Authenticator $authenticator */
        $authenticator = $this->app->make(Authenticator::class);
        $cred = $authenticator->authenticate();
        $this->assertNotEmpty($cred);
        $this->assertEquals(28, strlen($cred));
    }
}
