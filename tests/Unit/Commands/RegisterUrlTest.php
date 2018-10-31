<?php

use Samerior\MobileMoney\Mpesa\Commands\Registra;
use Samerior\MobileMoney\Tests\TestCase;

/**
 * Class RegisterUrl
 */
class RegisterUrlTest extends TestCase
{
//    /** @test */
    public function it_has_the_register_command()
    {
        $command = Mockery::mock(Registra::class)->makePartial()
            ->shouldReceive('info')
            ->with('Encryption keys generated successfully.')
            ->getMock();
        $command->handle();
    }

}