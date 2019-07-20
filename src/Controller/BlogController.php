<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="blog_index")
     */
    public function index(PostRepository $repository, Request $request, PaginatorInterface $paginator)
    {

        $q = $request->query->get('q'); /* get text search */
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            10 /* limit per page */
        );

        return $this->render('admin/post/index.html.twig', [
            'posts' => $pagination,
        ]);
    }


    /**
     * @Route("/blog/{slug}", name="blog_detail")
     */
    public function detail($slug)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findOneBy(['slug' => $slug]);

        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        return $this->render('blog/detail.html.twig', [
            'post' => $post,
        ]);
    }
}
