<?php

use kalanis\kw_filter\FilterEntry;
use kalanis\kw_filter\Interfaces\IFilterEntry;


class CommonTestClass extends \PHPUnit\Framework\TestCase
{
    public function mockEntry1(): IFilterEntry
    {
        return (new FilterEntry())->setKey('foo')->setValue('abc');
    }

    public function mockEntry2(): IFilterEntry
    {
        return (new FilterEntry())->setKey('bar')->setValue('def')->setRelation(FilterEntry::RELATION_MORE);
    }

    public function mockEntry3(): IFilterEntry
    {
        return (new FilterEntry())->setKey('baz')->setValue('ghi')->setRelation(FilterEntry::RELATION_LESS);
    }
}
