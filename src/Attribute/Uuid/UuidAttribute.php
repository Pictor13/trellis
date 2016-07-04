<?php

namespace Trellis\Attribute\Uuid;

use Trellis\Attribute\Attribute;
use Trellis\Entity\EntityInterface;

class UuidAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function createValue(EntityInterface $parent, $value = null)
    {
        return $value !== null ? new Uuid($value) : new Uuid;
    }
}
