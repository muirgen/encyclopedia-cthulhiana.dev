<?php

namespace Encyclopedia\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\Catalogues;

/**
 * Description of DefaultController
 *
 * @author Jenny
 *
 * @Route("{_locale}/catalogues", defaults={"_locale" = "en"}, requirements={"_locale" = "en|de|fr"})
 */
class CataloguesController extends Controller
{
    
    /**
     * @Route("/", name="_catalogues")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('EncyclopediaFrontBundle:Catalogues:index.html.twig');
    }
    
    
}
