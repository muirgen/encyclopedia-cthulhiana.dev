<?php

namespace Encyclopedia\RessourcesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EncyclopediaRessourcesBundle:Default:index.html.twig', array('name' => $name));
    }
}
