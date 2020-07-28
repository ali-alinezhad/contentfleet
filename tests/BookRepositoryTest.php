<?php


namespace App\Tests;


use App\Entity\Book;
use App\Repository\BookRepository;
use PHPUnit\Framework\TestCase;

class BookRepositoryTest extends TestCase
{
    public function testFindAllBooks()
    {
        $book = new Book();
        $matcher = $this->createMock(BookRepository::class);
        $matcher->method('findAllBooks')->willReturn($book);
        $this->assertEquals($book,$matcher->findAllBooks());
    }

    public function testFindMoreBooks()
    {
        $matcher = $this->createMock(BookRepository::class);
        $matcher->method('findMoreBooks')->willReturn(\ArrayObject::class);
        $this->assertEquals(\ArrayObject::class,$matcher->findMoreBooks(5));
    }

    public function testFindBooksInSameGenre()
    {
        $book = new Book();
        $matcher = $this->createMock(BookRepository::class);
        $matcher->method('findBooksInSameGenre')->willReturn($book);
        $this->assertEquals($book,$matcher->findBooksInSameGenre('Drama'));
    }
}
