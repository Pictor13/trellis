<?php

namespace Trellis\Tests\Runtime\Fixtures;

use Trellis\Common\Options;
use Trellis\Runtime\Attribute\AttributeInterface;
use Trellis\Runtime\Attribute\Text\TextAttribute;
use Trellis\Runtime\Attribute\EntityReferenceList\EntityReferenceListAttribute;
use Trellis\Runtime\EntityType;
use Trellis\Runtime\EntityTypeInterface;
use Trellis\Runtime\ReferencedEntityTypeInterface;

class ReferencedCategoryType extends EntityType implements ReferencedEntityTypeInterface
{
    public function __construct(EntityTypeInterface $parent, AttributeInterface $parent_attribute)
    {
        parent::__construct(
            'ReferencedCategory',
            [
                new TextAttribute('identifier', $this, [], $parent_attribute),
                new TextAttribute('referenced_identifier', $this, [], $parent_attribute),
                new EntityReferenceListAttribute(
                    'subcategories',
                    $this,
                    [
                        EntityReferenceListAttribute::OPTION_ENTITY_TYPES => [ ReferencedSubCategoryType::CLASS ]
                    ],
                    $parent_attribute
                )
            ],
            new Options(
                [ 'referenced_type' => CategoryType::CLASS, 'identifying_attribute' => 'identifier' ]
            ),
            $parent,
            $parent_attribute
        );
    }

    public static function getEntityImplementor()
    {
        return ReferencedCategory::CLASS;
    }

    public function getReferencedAttributeName()
    {
        return 'categories';
    }

    public function getReferencedTypeClass()
    {
        return CategoryType::CLASS;
    }
}
