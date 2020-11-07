<?php

namespace Filter;


/**
 * Class FilterArrayEntry
 * @package Filter
 * Filtering by array, not by just simple compare
 */
class FilterArrayEntry extends AFilterEntry
{
    protected static $relations = [
        self::RELATION_IN,
        self::RELATION_NOT_IN,
    ];

    protected $relation = self::RELATION_IN;
    protected $value = [];

    public function setValue($value): IFilterEntry
    {
        $this->value = (array)$value;
        return $this;
    }
}
