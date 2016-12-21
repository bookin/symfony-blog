<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBlogBundle:Page:index.html.twig');
    }


    public function aboutAction()
    {
        return $this->render('BlogBlogBundle:Page:about.html.twig');
    }

}
