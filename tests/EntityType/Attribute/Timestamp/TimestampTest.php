<?php

namespace Trellis\Tests\EntityType\Attribute\Timestamp;

use DateTimeImmutable;
use Trellis\EntityType\Attribute\Timestamp\Timestamp;
use Trellis\Entity\Value\ValueInterface;
use Trellis\Tests\TestCase;

class TimestampTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(ValueInterface::CLASS, new Timestamp(new DateTimeImmutable));
    }

    public function testToNative()
    {
        $native_val = '2016-07-04T19:27:07.000000+02:00';
        $timestamp = Timestamp::createFromString($native_val);
        $this->assertEquals($native_val, $timestamp->toNative());

        $timestamp = new Timestamp;
        $this->assertNull($timestamp->toNative());
    }

    public function testIsEmpty()
    {
        $native_val = '2016-07-04T19:27:07.000000+02:00';
        $timestamp = Timestamp::createFromString($native_val);
        $this->assertFalse($timestamp->isEmpty());

        $timestamp = new Timestamp(null);
        $this->assertTrue($timestamp->isEmpty());

        $timestamp = new Timestamp;
        $this->assertTrue($timestamp->isEmpty());
    }
}