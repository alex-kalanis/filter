<?php

namespace Filter;


/**
 * Class AFilterEntry
 * @package Filter
 * Abstraction class for filter entries
 */
abstract class AFilterEntry implements IFilterEntry
{
    protected static $relations = [];

    protected $key = '';
    protected $value = '';
    protected $relation = self::RELATION_EQUAL;

    public function setKey(string $key): IFilterEntry
    {
        $this->key = $key;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setRelation(string $relation): IFilterEntry
    {
        $this->relation = in_array($relation, static::$relations) ? $relation : $this->relation;
        return $this;
    }

    public function getRelation(): string
    {
        return $this->relation;
    }
}
