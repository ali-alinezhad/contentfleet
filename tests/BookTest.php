<?php


namespace App\Tests;


use App\Entity\Book;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testUserCreate(){
        $user = new User();
        $user->setUserName("Name");

        $this->assertEquals("Name", $user->getUserName());
    }

    public function testBookName(){
        $user = new Book();
        $user->SetName("Name");
        $this->assertEquals("Name", $user->getName());
    }

    public function testBookLength(){
        $user = new Book();
        $user->SetLength(1000);
        $this->assertEquals(1000, $user->getLength());
    }
}
