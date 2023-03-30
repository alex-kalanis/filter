<?php

namespace kalanis\kw_filter;


/**
 * Class FilterArrayEntry
 * @package kalanis\kw_filter
 * Filtering by array, not by just simple compare
 */
class FilterArrayEntry extends AFilterEntry
{
    protected static $relations = [
        self::RELATION_IN,
        self::RELATION_NOT_IN,
    ];

    protected $relation = self::RELATION_IN;
    /** @var string[] */
    protected $value = [];

    public function setValue($value): Interfaces\IFilterEntry
    {
        $this->value = array_map('strval', $this->toArray($value));
        return $this;
    }

    /**
     * @param string|string[]|Interfaces\IFilterEntry $value
     * @return string[]
     */
    protected function toArray($value): array
    {
        if (is_object($value)) {
            return [strval($value)];
        } elseif (is_numeric($value)) {
            return [strval($value)];
        } elseif (is_scalar($value)) {
            return [strval($value)];
        } else {
            return $value;
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}
