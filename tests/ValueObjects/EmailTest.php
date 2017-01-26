<?php
namespace Tdd\ValueObjects;

use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{

    public function testEmailIsValid()
    {
        $this->expectException(\Tdd\Exception\InvalidEmailException::class);
        new Email('jonDoe');
    }
}