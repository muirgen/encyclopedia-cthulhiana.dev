<?php

namespace Encyclopedia\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EncyclopediaFrontBundle:Default:index.html.twig');
    }
}
