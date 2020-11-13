<?php

namespace Filter;


/**
 * Class FilterEntry
 * @package Filter
 * Basic filter by entry value
 */
class FilterEntry extends AFilterEntry
{
    protected static $relations = [
        self::RELATION_EQUAL,
        self::RELATION_NOT_EQUAL,
        self::RELATION_LESS,
        self::RELATION_LESS_EQ,
        self::RELATION_MORE,
        self::RELATION_MORE_EQ,
        self::RELATION_EMPTY,
        self::RELATION_NOT_EMPTY,
    ];

    public function setValue($value): IFilterEntry
    {
        $this->value = (string)$value;
        return $this;
    }
}
