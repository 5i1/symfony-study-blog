<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Service\UploaderHelper;

class UserController extends AbstractController
{

    /**
     * @Route("/admin/users", name="admin_user_index")
     */
    public function index(UserRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q'); /* get text search */
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            10 /* limit per page */
        );

        return $this->render('admin/user/index.html.twig', [
            'users' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/user/{id}/delete", name="admin_user_delete")
     */
    public function delete(User $user, EntityManagerInterface $em)
    {

        if ($user instanceof User) {

            // Set an date to delete.
            $user->setDeleted(new \DateTime());

            // To save.
            $em->persist($user);
            $em->flush();

            // Set an message after save.
            $this->addFlash('success', 'User Deleted!');
        }

        // Redirect to list.
        return $this->redirectToRoute('admin_user_index');
    }
}
