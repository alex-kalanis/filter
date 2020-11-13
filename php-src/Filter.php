<?php

namespace Filter;


use Traversable;


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
    protected $entries = [];
    /** @var string */
    protected $relation = self::RELATION_EVERYTHING;

    public function getEntries(): Traversable
    {
        yield from $this->entries;
    }

    public function setValue($value): IFilterEntry
    {
        if ($value instanceof IFilterEntry) {
            $this->addFilter($value);
        }
        return $this;
    }

    public function addFilter(IFilterEntry $filter): IFilter
    {
        $this->entries[] = $filter;
        return $this;
    }

    public function remove(string $inputKey): IFilter
    {
        foreach ($this->entries as $index => $entry) {
            if ($entry->getKey() == $inputKey) {
                unset($this->entries[$index]);
            }
        }
        return $this;
    }

    public function clear(): IFilter
    {
        $this->entries = [];
        return $this;
    }

    public function getDefaultItem(): IFilterEntry
    {
        return new FilterEntry();
    }
}
