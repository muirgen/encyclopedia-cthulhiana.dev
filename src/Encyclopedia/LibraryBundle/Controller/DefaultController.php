<?php

namespace Encyclopedia\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EncyclopediaLibraryBundle:Default:index.html.twig');
    }
}
