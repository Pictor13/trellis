<?php

namespace Trellis\Tests\EntityType\Attribute\Integer;

use Trellis\EntityType\Attribute\AttributeInterface;
use Trellis\EntityType\Attribute\Integer\Integer;
use Trellis\EntityType\Attribute\Integer\IntegerAttribute;
use Trellis\EntityType\EntityTypeInterface;
use Trellis\Tests\TestCase;

class IntegerAttributeTest extends TestCase
{
    public function testConstruct()
    {
        $entity_type = $this->getMockBuilder(EntityTypeInterface::class)->getMock();
        $int_attribute = new IntegerAttribute('my_int', $entity_type);

        $this->assertInstanceOf(AttributeInterface::CLASS, $int_attribute);
        $this->assertEquals('my_int', $int_attribute->getName());
        $this->assertEquals($entity_type, $int_attribute->getEntityType());
    }

    public function testCreateValue()
    {
        $entity_type = $this->getMockBuilder(EntityTypeInterface::class)->getMock();
        $int_attribute = new IntegerAttribute('my_int', $entity_type);

        $this->assertInstanceOf(Integer::CLASS, $int_attribute->createValue());
        $this->assertInstanceOf(Integer::CLASS, $int_attribute->createValue(new Integer(42)));
        $this->assertInstanceOf(Integer::CLASS, $int_attribute->createValue(5));
    }
}
