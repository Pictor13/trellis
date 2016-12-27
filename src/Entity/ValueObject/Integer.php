<?php

namespace Trellis\Entity\ValueObject;

use Trellis\Entity\ValueObjectInterface;
use Trellis\Assert\Assertion;

final class Integer implements ValueObjectInterface
{
    const EMPTY = null;

    /**
     * @var int $integer
     */
    private $integer;

    /**
     * @param int $integer
     */
    public function __construct(int $integer = self::EMPTY)
    {
        $this->integer = $integer;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(ValueObjectInterface $other_value): bool
    {
        Assertion::isInstanceOf($other_value, Integer::CLASS);
        return $this->toNative() === $other_value->toNative();
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return $this->integer === self::EMPTY;
    }

    /**
     * @return null|int
     */
    public function toNative(): ?int
    {
        return $this->integer;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->isEmpty() ? "null" : (string)$this->integer;
    }
}