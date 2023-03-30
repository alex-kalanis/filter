<?php

namespace BasicTests;


use CommonTestClass;
use kalanis\kw_filter\FilterEntry;
use kalanis\kw_filter\Interfaces\IFilterEntry;


class EntryTest extends CommonTestClass
{
    public function testEntry(): void
    {
        $entry = new FilterEntry();
        $this->assertEmpty($entry->getKey());
        $this->assertEmpty($entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_EQUAL, $entry->getRelation());
    }

    /**
     * @param string $keys
     * @param string $expected
     * @dataProvider keyProvider
     */
    public function testKeys(string $keys, string $expected): void
    {
        $entry = new FilterEntry();
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
     * @param string $expected
     * @dataProvider valueProvider
     */
    public function testValues($values, string $expected): void
    {
        $entry = new FilterEntry();
        $entry->setValue($values);
        $this->assertEquals($expected, $entry->getValue());
    }

    public function valueProvider(): array
    {
        return [
            ['poi', 'poi'],
            [['dggh', 'sdfhg'], 'dggh'],
            [[1353, 'ysdg'], '1353'],
            [false, ''],
            [true, '1'],
            [$this->getAnonClass(), 'fbjgf'],
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     * @dataProvider relationProvider
     */
    public function testRelations(string $value, string $expected): void
    {
        $entry = new FilterEntry();
        $entry->setRelation($value);
        $this->assertEquals($expected, $entry->getRelation());
    }

    public function relationProvider(): array
    {
        return [
            [IFilterEntry::RELATION_EQUAL, IFilterEntry::RELATION_EQUAL],
            [IFilterEntry::RELATION_MORE, IFilterEntry::RELATION_MORE],
            ['bad', IFilterEntry::RELATION_EQUAL],
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
