<?php

namespace Trellis\Tests\Fixture;

use Trellis\DomainEntityInterface;
use Trellis\EntityType\AttributeMap;
use Trellis\EntityType\Attribute\EntityListAttribute;
use Trellis\EntityType\Attribute\IntegerAttribute;
use Trellis\EntityType\Attribute\TextAttribute;
use Trellis\EntityType\EntityType;

final class ArticleType extends EntityType
{
    public function __construct()
    {
        parent::__construct(
            'Article',
            new AttributeMap([
                new IntegerAttribute('id', $this),
                new TextAttribute('title', $this),
                new EntityListAttribute('content_objects', $this, [
                    EntityListAttribute::OPTION_TYPES => [ ParagraphType::CLASS ]
                ])
            ])
        );
    }

    /**
     * @param array $data
     * @param null|DomainEntityInterface $parent
     *
     * @return DomainEntityInterface
     */
    public function makeEntity(array $data = [], DomainEntityInterface $parent = null): DomainEntityInterface
    {
        return new Article($this, $data, $parent);
    }
}
