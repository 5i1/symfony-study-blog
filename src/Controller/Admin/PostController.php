<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{

    /**
     * @Route("/admin/posts", name="admin_post_index")
     */
    public function index()
    {

        return $this->render('admin/post/index.html.twig');
    }

    /**
     * @Route("/admin/post/add", name="admin_post_add")
     */
    public function add()
    {

        return $this->render('admin/post/add.html.twig');
    }
}
