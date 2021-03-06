from typing import List

from entities.movie_entity import Movie


class MovieRepository:
    """object that manages Movie entities."""


    def __init__(self):
        self.__movies = {}
        self.__count = 0


    def insert(self, m: Movie) -> int:
        """Insert movie.

        If added for the first time, an id will be assigned.
        """

        if not hasattr(m, 'id'):
            m.id = self.__count
            self.__count += 1

        self.__movies[m.id] = m

        return m.id


    def get(self, id: str) -> Movie:
        """Get movie by id."""

        return self.__movies[id]


    def get_all(self) -> List[Movie]:
        """Return all entities."""

        return list(self.__movies.values())


    def delete(self, id: int):
        """Delete movie by id."""

        del self.__movies[id]
