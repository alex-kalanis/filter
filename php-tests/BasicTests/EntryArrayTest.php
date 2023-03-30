<?php

namespace BasicTests;


use CommonTestClass;
use kalanis\kw_filter\FilterArrayEntry;
use kalanis\kw_filter\Interfaces\IFilterEntry;


class EntryArrayTest extends CommonTestClass
{
    public function testEntry(): void
    {
        $entry = new FilterArrayEntry();
        $this->assertEmpty($entry->getKey());
        $this->assertEmpty($entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_IN, $entry->getRelation());
    }

    /**
     * @param string $keys
     * @param string $expected
     * @dataProvider keyProvider
     */
    public function testKeys(string $keys, string $expected): void
    {
        $entry = new FilterArrayEntry();
        $entry->setKey($keys);
        $this->assertEquals($expected, $entry->getKey());
    }

    public function keyProvider(): array
    {
        return [
            ['any', 'any'],
        ];
    }

    /**
     * @param mixed $values
     * @param string[] $expected
     * @dataProvider valueProvider
     */
    public function testValues($values, array $expected): void
    {
        $entry = new FilterArrayEntry();
        $entry->setValue($values);
        $this->assertEquals($expected, $entry->getValue());
    }

    public function valueProvider(): array
    {
        return [
            ['poi', ['poi']],
            [['dum', 'din', 'don'], ['dum', 'din', 'don']],
            [[1353, 'ysdg'], ['1353', 'ysdg']],
            [864, ['864']],
            [false, ['']],
            [$this->getAnonClass(), ['fbjgf']],
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     * @dataProvider relationProvider
     */
    public function testRelations(string $value, string $expected): void
    {
        $entry = new FilterArrayEntry();
        $entry->setRelation($value);
        $this->assertEquals($expected, $entry->getRelation());
    }

    public function relationProvider(): array
    {
        return [
            [IFilterEntry::RELATION_NOT_IN, IFilterEntry::RELATION_NOT_IN],
            ['bad', IFilterEntry::RELATION_IN],
        ];
    }

    protected function getAnonClass(): object
    {
        return new class {
            public function __toString()
            {
                return 'fbjgf';
            }
        };
    }
}
