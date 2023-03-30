<?php

namespace kalanis\kw_filter;


/**
 * Class FilterEntry
 * @package kalanis\kw_filter
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

    /** @var string */
    protected $value = '';

    public function setValue($value): Interfaces\IFilterEntry
    {
        $this->value = $this->toString($value);
        return $this;
    }

    /**
     * @param string|string[]|Interfaces\IFilterEntry $value
     * @return string
     */
    protected function toString($value): string
    {
        if (is_array($value)) {
            return strval(reset($value));
        } else {
            return strval($value);
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}
