<?php

namespace Trellis\Path;

use Trellis\Collection\TypedList;

class TrellisPath extends TypedList implements TrellisPathInterface
{
    public function __construct($path_parts)
    {
        parent::__construct(TrellisPathPartInterface::CLASS, $path_parts);
    }

    public function __toString()
    {
        return array_reduce($this->items, function ($path, TrellisPathPartInterface $path_part) {
            return empty($path) ? $path_part : ($path.'.'.$path_part);
        }, '');
    }
}
