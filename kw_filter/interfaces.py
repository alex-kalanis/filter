
class IFilterEntry:
    """
     * Basic entry for filtering
    """

    RELATION_EQUAL = 'eq'
    RELATION_NOT_EQUAL = 'neq'
    RELATION_LESS = 'lt'
    RELATION_LESS_EQ = 'lteq'
    RELATION_MORE = 'gt'
    RELATION_MORE_EQ = 'gteq'
    RELATION_EMPTY = 'empty'
    RELATION_NOT_EMPTY = 'nempty'
    RELATION_IN = 'in'
    RELATION_NOT_IN = 'nin'

    def set_key(self, key: str):
        """
         * Set by which key the entry will be defined
        """
        raise NotImplementedError('TBA')

    def get_key(self) -> str:
        """
         * Filter by which entry - getter
        """
        raise NotImplementedError('TBA')

    def set_value(self, value):
        """
         * Add/set entry value to compare
         * @param string|string[]|IFilterEntry $value
        """
        raise NotImplementedError('TBA')

    def get_value(self):
        """
         * What values will be set to filter
         * @return string|string[]|IFilterEntry[]
        """
        raise NotImplementedError('TBA')

    def set_relation(self, relation: str):
        """
         * Set relationship between filters
         * Preferably use constants in IFilter
        """
        raise NotImplementedError('TBA')

    def get_relation(self) -> str:
        """
         * What relation will be used
         * Preferably use constants above
        """
        raise NotImplementedError('TBA')


class IFilter(IFilterEntry):
    """
     * Composite of filters for selecting wanted items
    """

    RELATION_EVERYTHING = 'and'
    RELATION_ANYTHING = 'or'

    def get_entries(self):
        """
         * Get entries in filtering
         * @return Traversable IFilterEntry
        """
        raise NotImplementedError('TBA')

    def add_filter(self, filter_entry: IFilterEntry):
        """
         * Add entry to filter
        """
        raise NotImplementedError('TBA')

    def remove(self, filter_key: str):
        """
         * Remove all entries which has key
        """
        raise NotImplementedError('TBA')

    def clear(self):
        """
         * Clear filters
        """
        raise NotImplementedError('TBA')

    def get_default_item(self) -> IFilterEntry:
        """
         * Return new entry usable for filtering
        """
        raise NotImplementedError('TBA')
