<?php

namespace Trellis\Tests\Fixture;

use Trellis\EntityType\Params;
use Trellis\TypedEntityInterface;
use Trellis\EntityType\AttributeMap;
use Trellis\EntityType\Attribute\EntityListAttribute;
use Trellis\EntityType\Attribute\IntegerAttribute;
use Trellis\EntityType\Attribute\TextAttribute;
use Trellis\EntityType\EntityType;

final class ArticleType extends EntityType
{
    public function __construct()
    {
        $content_object_params = [
            EntityListAttribute::OPTION_TYPES => [
                ParagraphType::CLASS,
                LocationType::CLASS
            ]
        ];
        parent::__construct(
            'Article',
            new AttributeMap([
                new IntegerAttribute('id', $this),
                new TextAttribute('title', $this),
                new EntityListAttribute('content_objects', $this, $content_object_params)
            ]),
            new Params([ "prefix" => "article" ])
        );
    }

    /**
     * @param array $data
     * @param null|TypedEntityInterface $parent
     *
     * @return TypedEntityInterface
     */
    public function makeEntity(array $data = [], TypedEntityInterface $parent = null): TypedEntityInterface
    {
        return new Article($this, $data, $parent);
    }
}
