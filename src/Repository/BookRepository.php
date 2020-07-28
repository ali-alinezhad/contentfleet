<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAllBooks()
    {
        return $this->createQueryBuilder('book')
            ->setMaxResults(5);
    }

    /**
     * @param $lastId
     * @return mixed
     */
    public function findMoreBooks($lastId)
    {
        $books = $this->createQueryBuilder('a')
            ->where('a.id > '.++$lastId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        $i = 0;
        foreach($books as $book) {
            $temp = array(
                'id'             => $book->getId(),
                'name'           => $book->getName(),
                'release_date'   => $book->getReleaseDate()->format('d-m-Y'),
                'length'         => $book->getLength(),
                'genres'         => $book->getGenres(),
                'user_readable'  => $book->getUserReadable(),
                'admin_readable' => $book->getAdminReadable()

            );
            $data[$i++] = $temp;
        }

        return $data;
    }

    /**
     * @param $genre
     * @return int|mixed|string
     */
    public function findBooksInSameGenre($genre)
    {
        return $this->createQueryBuilder('book')
            ->where('book.genres LIKE :genres')
            ->setParameter('genres', '%'.$genre.'%')
            ->getQuery()->getResult();
    }
}
