<?php

namespace Trellis\Attribute\TextList;

use Trellis\Attribute\Attribute;
use Trellis\Entity\EntityInterface;

class TextListAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function createValue(EntityInterface $parent, $value = null)
    {
        return $value !== null ? new TextList($value) : new TextList;
    }
}
