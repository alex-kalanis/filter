<?php

namespace kalanis\kw_filter;


/**
 * Class AFilterEntry
 * @package kalanis\kw_filter
 * Abstraction class for filter entries
 */
abstract class AFilterEntry implements Interfaces\IFilterEntry
{
    /** @var string[] */
    protected static $relations = [];

    /** @var string */
    protected $key = '';
    /** @var string */
    protected $relation = self::RELATION_EQUAL;

    public function setKey(string $key): Interfaces\IFilterEntry
    {
        $this->key = $key;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setRelation(string $relation): Interfaces\IFilterEntry
    {
        $this->relation = in_array($relation, static::$relations) ? $relation : $this->relation;
        return $this;
    }

    public function getRelation(): string
    {
        return $this->relation;
    }
}
