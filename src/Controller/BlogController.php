<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="blog_index")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
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
