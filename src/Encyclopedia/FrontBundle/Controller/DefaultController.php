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
 * @Route("/")
 */
class DefaultController extends Controller
{
    
    /**
     * @Route("/{_locale}/", name="_homepage", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"})
     * @Route("/", name="_homepagewithoutlocale")
     * @Template()
     */
    public function indexAction()
    {
    
        return $this->render('EncyclopediaFrontBundle:Default:index.html.twig');
    }
    
    public function randomIndexAction(){
        
        $idLocale = $this->get('kernel.listener.languages')->getIdLanguage();
        $em = $this->getDoctrine()->getManager();
        $ri = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->findByRand($idLocale);
        
        return $this->render('EncyclopediaFrontBundle:Default:randomIndex.html.twig',
                    array('ri' => $ri)
                
                );
                
    }
    
}
