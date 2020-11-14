import unittest
from kw_filter.filter import FilterEntry


class CommonTestClass(unittest.TestCase):

    def _mock_entry_1(self) -> FilterEntry:
        return FilterEntry().set_key('foo').set_value('abc')

    def _mock_entry_2(self) -> FilterEntry:
        return FilterEntry().set_key('bar').set_value('def').set_relation(FilterEntry.RELATION_MORE)

    def _mock_entry_3(self) -> FilterEntry:
        return FilterEntry().set_key('baz').set_value('ghi').set_relation(FilterEntry.RELATION_LESS)
