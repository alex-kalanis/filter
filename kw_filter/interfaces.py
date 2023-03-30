
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

        Parameters
        ----------
        key: str

        Returns
        -------
        IFilterEntry

        """
        raise NotImplementedError('TBA')

    def get_key(self) -> str:
        """
         * Filter by which entry - getter

        Returns
        -------
        str

        """
        raise NotImplementedError('TBA')

    def set_value(self, value):
        """
         * Add/set entry value to compare

        Parameters
        ----------
        value: str|list[str]|IFilterEntry

        Returns
        -------
        IFilterEntry

        """
        raise NotImplementedError('TBA')

    def get_value(self):
        """
         * What values will be set to filter

        Returns
        -------
        str|list[str]|list[IFilterEntry]

        """
        raise NotImplementedError('TBA')

    def set_relation(self, relation: str):
        """
         * Set relationship between filters
         * Preferably use constants in IFilter

        Parameters
        ----------
        relation: str

        Returns
        -------
        IFilterEntry

        """
        raise NotImplementedError('TBA')

    def get_relation(self) -> str:
        """
         * What relation will be used
         * Preferably use constants above

        Returns
        -------
        str

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

        Yields
        -------
        IFilterEntry

        """
        raise NotImplementedError('TBA')

    def add_filter(self, filter_entry: IFilterEntry):
        """
         * Add entry to filter

        Parameters
        ----------
        filter_entry: IFilterEntry

        Returns
        -------
        IFilter

        """
        raise NotImplementedError('TBA')

    def remove(self, filter_key: str):
        """
         * Remove all entries which has key

        Parameters
        ----------
        filter_key: str

        Returns
        -------
        IFilter

        """
        raise NotImplementedError('TBA')

    def clear(self):
        """
         * Clear filters

        Returns
        -------
        IFilter

        """
        raise NotImplementedError('TBA')

    def get_default_item(self) -> IFilterEntry:
        """
         * Return new entry usable for filtering

        Returns
        -------
        IFilterEntry

        """
        raise NotImplementedError('TBA')
