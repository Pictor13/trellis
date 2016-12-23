<?php

namespace Trellis\Error\Assert;

use Assert\Assert as BaseAssert;
use Trellis\Error\LazyAssertionFailed;

abstract class Assert extends BaseAssert
{
    /**
     * @var string
     */
    protected static $lazyAssertionExceptionClass = LazyAssertionFailed::CLASS;

    /**
     * @var string
     */
    protected static $assertionClass = Assertion::CLASS;
}
