<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
