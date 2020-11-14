

from .interfaces import IFilter, IFilterEntry


class AFilterEntry(IFilterEntry):
    """
     * Abstraction class for filter entries
    """

    _relations = []

    def __init__(self):
        self._key = ''
        self._value = ''
        self._relation = self.RELATION_EQUAL

    def set_key(self, key: str):
        self._key = key
        return self

    def get_key(self) -> str:
        return self._key

    def get_value(self):
        return self._value

    def set_relation(self, relation: str):
        self._relation = relation if relation in self._relations else self._relation
        return self

    def get_relation(self) -> str:
        return self._relation


class FilterEntry(AFilterEntry):
    """
     * Basic filter by entry value
    """

    _relations = [
        IFilterEntry.RELATION_EQUAL,
        IFilterEntry.RELATION_NOT_EQUAL,
        IFilterEntry.RELATION_LESS,
        IFilterEntry.RELATION_LESS_EQ,
        IFilterEntry.RELATION_MORE,
        IFilterEntry.RELATION_MORE_EQ,
        IFilterEntry.RELATION_EMPTY,
        IFilterEntry.RELATION_NOT_EMPTY,
    ]

    def set_value(self, value):
        self._value = str(value)
        return self


class FilterArrayEntry(AFilterEntry):
    """
     * Filtering by array, not by just simple compare
    """

    _relations = [
        IFilterEntry.RELATION_IN,
        IFilterEntry.RELATION_NOT_IN,
    ]

    def __init__(self):
        super().__init__()
        self._relation = self.RELATION_IN
        self._value = []

    def set_value(self, value):
        self._value = value
        return self


class Filter(IFilter, AFilterEntry):
    """
     * Filter for selecting wanted items - structure
    """

    _relations = [
        IFilter.RELATION_EVERYTHING,
        IFilter.RELATION_ANYTHING,
    ]

    def __init__(self):
        super().__init__()
        self._relation = self.RELATION_EVERYTHING
        self._entries = []

    def get_entries(self):
        yield from self._entries

    def set_value(self, value):
        if isinstance(value, IFilterEntry):
            self.add_filter(value)
        return self

    def add_filter(self, filter_entry: IFilterEntry):
        self._entries.append(filter_entry)
        return self

    def remove(self, input_key: str):
        left = []
        for entry in self._entries:
            if entry.get_key() != input_key:
                left.append(entry)
        self._entries = left
        return self

    def clear(self):
        self._entries = []
        return self

    def get_default_item(self) -> IFilterEntry:
        return FilterEntry()
