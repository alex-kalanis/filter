<?php

namespace BasicTests;

use CommonTestClass;
use Filter\Filter;
use Filter\FilterArrayEntry;
use Filter\FilterEntry;
use Filter\Interfaces\IFilterEntry;


class BasicTest extends CommonTestClass
{

    public function testEntry(): void
    {
        $entry = new FilterEntry();
        $this->assertEmpty($entry->getKey());
        $this->assertEmpty($entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_EQUAL, $entry->getRelation());

        $entry->setKey('any');
        $this->assertEquals('any', $entry->getKey());
        $this->assertEmpty($entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_EQUAL, $entry->getRelation());

        $entry->setValue('poi');
        $this->assertEquals('any', $entry->getKey());
        $this->assertEquals('poi', $entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_EQUAL, $entry->getRelation());

        $entry->setRelation(IFilterEntry::RELATION_LESS);
        $this->assertEquals('any', $entry->getKey());
        $this->assertEquals('poi', $entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_LESS, $entry->getRelation());

        $entry->setRelation('bad');
        $this->assertEquals('any', $entry->getKey());
        $this->assertEquals('poi', $entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_LESS, $entry->getRelation());
    }

    public function testEntryArrays(): void
    {
        $entry = new FilterArrayEntry();
        $this->assertEmpty($entry->getKey());
        $this->assertEmpty($entry->getValue());
        $this->assertEquals(IFilterEntry::RELATION_IN, $entry->getRelation());

        $entry->setValue(['dum', 'din', 'don']);
        $this->assertEquals(3, count($entry->getValue()));

        $entry->setValue('dummy');
        $this->assertEquals(['dummy'], $entry->getValue());

        // not usable relation
        $entry->setRelation(IFilterEntry::RELATION_EQUAL);
        $this->assertEquals(IFilterEntry::RELATION_IN, $entry->getRelation());
    }

    public function testFilterBasic(): void
    {
        $filter = new Filter();
        $this->assertEmpty($filter->getValue());

        $this->assertInstanceOf('\Filter\Interfaces\IFilterEntry', $filter->getDefaultItem());

        $filter->setValue($this->mockEntry1());
        $filter->setValue($this->mockEntry2());
        $filter->setValue($this->mockEntry3());

        $this->assertNotEmpty(iterator_to_array($filter->getEntries()));

        $filter->clear();
        $this->assertEmpty(iterator_to_array($filter->getEntries()));
    }

    public function testFilterRemoval(): void
    {
        $filter = new Filter();

        $filter->addFilter($this->mockEntry1());
        $filter->addFilter($this->mockEntry3());
        $filter->addFilter($this->mockEntry3()); // intentional
        $filter->addFilter($this->mockEntry2());

        $this->assertEquals(4, count(iterator_to_array($filter->getEntries())));

        $filter->remove($this->mockEntry3()->getKey());
        $this->assertEquals(2, count(iterator_to_array($filter->getEntries())));

        $filter->clear();
        $this->assertEmpty(iterator_to_array($filter->getEntries()));
    }

    public function testFilterOrder(): void
    {
        $filter = new Filter();

        $filter->addFilter($this->mockEntry1());
        $filter->addFilter($this->mockEntry3());
        $filter->addFilter($this->mockEntry2());

        /** @var IFilterEntry[] $result */
        $result = iterator_to_array($filter->getEntries());
        $this->assertEquals($this->mockEntry1()->getKey(), $result[0]->getKey());
        $this->assertEquals($this->mockEntry3()->getKey(), $result[1]->getKey());
        $this->assertEquals($this->mockEntry2()->getKey(), $result[2]->getKey());
    }

    public function testFilterWithinFilter(): void
    {
        $filter1 = new Filter();
        $filter2 = new Filter();

        $filter1->addFilter($this->mockEntry1());
        $filter2->addFilter($this->mockEntry2());
        $filter2->addFilter($this->mockEntry3());
        $filter2->setRelation(Filter::RELATION_ANYTHING);

        $filter1->addFilter($filter2);
        /// entry1 and (entry2 or entry3)

        /** @var Filter[] $result */
        $result = iterator_to_array($filter1->getEntries());
        $this->assertEquals(Filter::RELATION_EVERYTHING, $filter1->getRelation());
        $this->assertInstanceOf('\Filter\FilterEntry', $result[0]);
        $this->assertInstanceOf('\Filter\Filter', $result[1]);
        $this->assertEquals($this->mockEntry1()->getKey(), $result[0]->getKey());

        /** @var IFilterEntry[] $resultSub */
        $resultSub = iterator_to_array($result[1]->getEntries());
        $this->assertEquals(Filter::RELATION_ANYTHING, $result[1]->getRelation());
        $this->assertEquals($this->mockEntry2()->getKey(), $resultSub[0]->getKey());
        $this->assertEquals($this->mockEntry3()->getKey(), $resultSub[1]->getKey());
    }
}
