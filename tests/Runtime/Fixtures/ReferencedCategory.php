<?php

namespace Trellis\Tests\Runtime\Fixtures;

use Trellis\Runtime\Entity\Entity;
use Trellis\Runtime\Entity\EntityReferenceInterface;

class ReferencedCategory extends Entity implements EntityReferenceInterface
{
    public function getIdentifier()
    {
        return $this->getValue('identifier');
    }

    public function getReferencedIdentifier()
    {
        return $this->getValue('referenced_identifier');
    }
}
