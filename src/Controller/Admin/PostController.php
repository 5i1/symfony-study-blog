<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;

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
    public function add(EntityManagerInterface $em, Request $request)
    {

        // Create the form based on the FormType we need.
        $post = new Post();
        $postForm = $this->createForm(PostType::class, $post);

        // Ask the form to handle the current request.
        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            // Process the submitted & validated data retrieved in $form->getData()
            // Form handling is *here*.

            $post->setSlug('example-of-slug');
            $post->setUser($this->getUser());
            $post->setCreated(new \DateTime());

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('admin_post_index');
        }

        return $this->render('admin/post/add.html.twig', [
            'postForm' => $postForm->createView()
        ]);
    }
}
