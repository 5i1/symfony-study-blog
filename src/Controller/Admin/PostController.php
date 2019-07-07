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
use App\Service\UploaderHelper;
use Gedmo\Sluggable\Util\Urlizer;

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
    public function add(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
    {

        // Create the form based on the FormType we need.
        $postForm = $this->createForm(PostType::class);

        // Ask the form to handle the current request.
        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {

            // Get data of form.
            $post = $postForm->getData();

            // Send an image file an store in /public.
            $uploadedFile = $postForm['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadImage($uploadedFile);
                $post->setUrlPhoto($newFilename);
            }

            // Set some others information of post.
            $post->setSlug('example-of-slug');
            $post->setUser($this->getUser());
            $post->setCreated(new \DateTime());

            // To save.
            $em->persist($post);
            $em->flush();

            // Set an message after save.
            $this->addFlash('success', 'Post Created!');

            // Redirect to another page.
            return $this->redirectToRoute('admin_post_index');
        }

        return $this->render('admin/post/add.html.twig', [
            'postForm' => $postForm->createView()
        ]);
    }
}
