from kw_filter.filter import Filter, FilterEntry, FilterArrayEntry, IFilterEntry
from kw_tests.common_class import CommonTestClass


class ItemTest(CommonTestClass):

    def test_entry(self):
        entry = FilterEntry()
        assert not entry.get_key()
        assert not entry.get_value()
        assert IFilterEntry.RELATION_EQUAL == entry.get_relation()

        entry.set_key('any')
        assert 'any' == entry.get_key()
        assert not entry.get_value()
        assert IFilterEntry.RELATION_EQUAL == entry.get_relation()

        entry.set_value('poi')
        assert 'any' == entry.get_key()
        assert 'poi' == entry.get_value()
        assert IFilterEntry.RELATION_EQUAL == entry.get_relation()

        entry.set_relation(IFilterEntry.RELATION_LESS)
        assert 'any', entry.get_key()
        assert 'poi', entry.get_value()
        assert IFilterEntry.RELATION_LESS == entry.get_relation()

        entry.set_relation('bad')
        assert 'any', entry.get_key()
        assert 'poi', entry.get_value()
        assert IFilterEntry.RELATION_LESS == entry.get_relation()

    def test_entry_arrays(self):
        entry = FilterArrayEntry()
        assert not entry.get_key()
        assert not entry.get_value()
        assert IFilterEntry.RELATION_IN == entry.get_relation()

        entry.set_value(['dum', 'din', 'don'])
        assert 3 == len(entry.get_value())

        ### how to check array?!
        # entry.set_value('dummy')
        # assert ['dummy'] == entry.get_value()

        # not usable relation
        entry.set_relation(IFilterEntry.RELATION_EQUAL)
        assert IFilterEntry.RELATION_IN == entry.get_relation()

    def test_filter_basic(self):
        filter = Filter()
        assert not self.iterator_to_array(filter.get_entries())

        assert isinstance(filter.get_default_item(), IFilterEntry)

        filter.set_value(self._mock_entry_1())
        filter.set_value(self._mock_entry_2())
        filter.set_value(self._mock_entry_3())

        assert self.iterator_to_array(filter.get_entries())

        filter.clear()
        assert not self.iterator_to_array(filter.get_entries())

    def test_filter_removal(self):
        filter = Filter()

        filter.add_filter(self._mock_entry_1())
        filter.add_filter(self._mock_entry_3())
        filter.add_filter(self._mock_entry_3())  # intentional
        filter.add_filter(self._mock_entry_2())

        assert 4 == len(self.iterator_to_array(filter.get_entries()))

        filter.remove(self._mock_entry_3().get_key())
        assert 2 == len(self.iterator_to_array(filter.get_entries()))

        filter.clear()
        assert not self.iterator_to_array(filter.get_entries())

    def test_filter_order(self):
        filter = Filter()

        filter.add_filter(self._mock_entry_1())
        filter.add_filter(self._mock_entry_3())
        filter.add_filter(self._mock_entry_2())

        result = self.iterator_to_array(filter.get_entries())
        assert self._mock_entry_1().get_key() == result[0].get_key()
        assert self._mock_entry_3().get_key() == result[1].get_key()
        assert self._mock_entry_2().get_key() == result[2].get_key()

    def test_filter_within_filter(self):
        filter1 = Filter()
        filter2 = Filter()

        filter1.add_filter(self._mock_entry_1())
        filter2.add_filter(self._mock_entry_2())
        filter2.add_filter(self._mock_entry_3())
        filter2.set_relation(Filter.RELATION_ANYTHING)

        filter1.add_filter(filter2)
        ### entry1 and (entry2 or entry3)

        result = self.iterator_to_array(filter1.get_entries())
        assert Filter.RELATION_EVERYTHING == filter1.get_relation()
        assert isinstance(result[0], FilterEntry)
        assert isinstance(result[1], Filter)
        assert self._mock_entry_1().get_key() == result[0].get_key()

        result_sub = self.iterator_to_array(result[1].get_entries())
        assert Filter.RELATION_ANYTHING == result[1].get_relation()
        assert self._mock_entry_2().get_key() == result_sub[0].get_key()
        assert self._mock_entry_3().get_key() == result_sub[1].get_key()
