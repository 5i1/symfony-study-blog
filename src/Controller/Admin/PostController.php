<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    /**
     * @Route("/admin/posts", name="admin_post_index")
     */
    public function index(PostRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q'); /* get text search */
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            8 /* limit per page */
        );

        return $this->render('admin/post/index.html.twig', [
            'posts' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/post/add", name="admin_post_add")
     */
    public function add()
    {

        return $this->render('admin/post/add.html.twig');
    }
}
