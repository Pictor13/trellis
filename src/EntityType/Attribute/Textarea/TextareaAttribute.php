<?php

namespace Trellis\EntityType\Attribute\Textarea;

use Trellis\EntityType\Attribute\Attribute;
use Trellis\Entity\EntityInterface;

class TextareaAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function createValue(EntityInterface $parent, $value = null)
    {
        if ($value instanceof Textarea) {
            return $value;
        }
        return $value !== null ? new Textarea($value) : new Textarea;
    }
}
