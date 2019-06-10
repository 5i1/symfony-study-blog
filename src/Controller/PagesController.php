<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends AbstractController
{

    /**
     * @Route("/about-me", name="pages_about_me")
     */
    public function aboutme()
    {

        return $this->render('pages/about-me.html.twig');
    }


    /**
     * @Route("/contact", name="pages_contact")
     */
    public function contact()
    {

        return $this->render('pages/contact.html.twig');
    }

    /**
     * @Route("/register", name="pages_register")
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,
                                  $user
                );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            );

            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->redirect('blog_index');
        }

        return $this->render('pages/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
