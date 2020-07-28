<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BookController extends AbstractController
{
    /**
     * @param BookRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(BookRepository $repository)
    {
        if (!$this->getUser()) {
            return $this->redirect('/login');
        }

        $books = $repository->findAllBooks();

        if ($this->getUser()->getUsername() === 'admin') {
            $books = $books->where('book.admin_readable = :temp')->setParameter('temp', 'Yes');
        } else {
            $books = $books->where('book.user_readable = :temp')->setParameter('temp', 'Yes');
        }

        if (!$books) {
            throw $this->createNotFoundException(
                'No books found'
            );
        }

        return $this->render('book/index.html.twig',[
            'books' => $books->getQuery()->getResult()
        ]);
    }

    /**
     * @param BookRepository $repository
     * @param Request $request
     * @return JsonResponse
     */
    public function loadMore(BookRepository $repository, Request $request)
    {
        $lastId = $request->request->get('lastId');
        return new JsonResponse($repository->findMoreBooks($lastId));
    }

    /**
     * @param BookRepository $repository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showBookDetails(BookRepository $repository,$id)
    {
        return $this->render('book/show_details.html.twig',[
            'books' => $repository->find($id)
        ]);
    }

    /**
     * @param BookRepository $repository
     * @param $genre
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showBooksInGenre(BookRepository $repository, $genre)
    {
        return $this->render('book/show_genres.html.twig',[
            'books' => $repository->findBooksInSameGenre($genre)
        ]);
    }
}
