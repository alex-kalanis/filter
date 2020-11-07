<?php

namespace Filter;


/**
 * Class Filter
 * Filter for selecting wanted items - structure
 */
class Filter extends AFilterEntry implements IFilter
{
    protected static $relations = [
        self::RELATION_EVERYTHING,
        self::RELATION_ANYTHING,
    ];

    /** @var IFilter[] */
    protected $value = [];
    /** @var string */
    protected $relation = self::RELATION_EVERYTHING;

    public function setValue($value): IFilterEntry
    {
        if ($value instanceof IFilterEntry) {
            $this->addFilter($value);
        }
        return $this;
    }

    public function addFilter(IFilterEntry $filter): IFilter
    {
        $this->value[] = $filter;
        return $this;
    }

    public function remove(string $inputKey): IFilter
    {
        foreach ($this->value as $index => $entry) {
            if ($entry->getKey() == $inputKey) {
                unset($this->value[$index]);
            }
        }
        return $this;
    }

    public function clear(): IFilter
    {
        $this->value = [];
        return $this;
    }
}
