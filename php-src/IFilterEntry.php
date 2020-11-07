<?php

namespace Filter;


/**
 * Interface IFilterEntry
 * @package Filter
 * Basic entry for filtering
 */
interface IFilterEntry
{
    const RELATION_EQUAL = 'eq';
    const RELATION_LESS = 'lt';
    const RELATION_LESS_EQ = 'lteq';
    const RELATION_MORE = 'gt';
    const RELATION_MORE_EQ = 'gteq';
    const RELATION_EMPTY = 'empty';
    const RELATION_NOT_EMPTY = '!empty';
    const RELATION_IN = 'in';
    const RELATION_NOT_IN = '!in';

    /**
     * Set by which key the entry will be defined
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): self;

    /**
     * Filter by which entry - getter
     * @return string
     */
    public function getKey(): string;

    /**
     * Add/set entry value to compare
     * @param string|string[]|IFilterEntry $value
     * @return $this
     */
    public function setValue($value): self;

    /**
     * What values will be set to filter
     * @return string|string[]|IFilterEntry[]
     */
    public function getValue();

    /**
     * Set relationship between filters
     * Preferably use constants in IFilter
     * @param string $relation
     * @return $this
     */
    public function setRelation(string $relation): self;

    /**
     * What relation will be used
     * Preferably use constants above
     * @return string
     */
    public function getRelation(): string;
}
