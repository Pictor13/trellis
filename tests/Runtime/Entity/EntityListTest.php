<?php

namespace Trellis\Tests\Runtime\Entity;

use Trellis\Runtime\Entity\EntityList;
use Trellis\Tests\Runtime\Fixtures\ArticleType;
use Trellis\Tests\TestCase;

class EntityListTest extends TestCase
{
    public function testCreateCollection()
    {
        $collection = new EntityList;

        $this->assertInstanceOf(EntityList::CLASS, $collection);
    }

    public function testAddEntityToEmptyCollection()
    {
        $type = new ArticleType;
        $collection = new EntityList;

        $test_entity = $type->createEntity();
        $collection->addItem($test_entity);

        $first_entity = $collection->getFirst();
        $this->assertEquals($test_entity, $first_entity);
    }

    public function testAddEntityToNonEmptyCollection()
    {
        $type = new ArticleType;
        $test_entity = $type->createEntity();

        $collection = new EntityList([ $test_entity ]);

        $collection->addItem($test_entity);

        $first_entity = $collection[0];
        $second_entity = $collection[1];

        $this->assertEquals($test_entity, $first_entity);
        $this->assertEquals($test_entity, $second_entity);
    }

    public function testGetEntityByIdenitifier()
    {
        $uuid = '539fb03b-9bc3-47d9-886d-77f56d390d94';
        $type = new ArticleType;
        $test_entity = $type->createEntity([ 'uuid' => $uuid ]);

        $collection = new EntityList([ $test_entity ]);

        $this->assertEquals($test_entity, $collection->getEntityByIdentifier($uuid));
        $this->assertNull($collection->getEntityByIdentifier('notfound'));
    }
}
