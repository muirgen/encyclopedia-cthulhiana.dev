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
 * @Route("{_locale}/catalogues", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"})
 */
class CataloguesController extends Controller {
    
    /**
     * @Route("/index-{letter}", name="_catalogues", defaults={"letter" = "A"})
     * @Route("/"), name="_catalogues"
     * @Template()
     */
    public function indexAction(Request $request, $letter = 'A') {

        $idLocale = $this->get('kernel.listener.languages')->getIdLang();
        $isoCode = $this->getRequest()->getLocale();

        $em = $this->getDoctrine()->getManager();

        $listCategories = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategoriesTrans')
                ->findAllByLocaleId($idLocale);
        
        $lastEntries = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')
                ->findAllWithLimit(15);
        
        $items = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->findByNameFirstLetterLike($letter,$isoCode);

        return array('listCategories' => $listCategories,
                    'lastEntries' => $lastEntries,
                    'items' => $items,
                    'currentLetter' => $letter);
    }

    /**
     * @Route("/autocomplete-search", name="_catalogues_autocomplete_search")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function autocompleteSearchAction(Request $request){
        
        $termSearch = $request->get('catalogue');
        $isoCode = $this->getRequest()->getLocale();
        
        $em = $this->getDoctrine()->getManager();
        
        $props = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->findByNameFirstLetterLike($termSearch,$isoCode);
        
        $array_props = array();
        
        foreach ($props as $key => $p):
            $array_props[$key + 1] = array('id' => $p['c_id'], 'name' => $p['c_name']);
        endforeach;
        
        //var_dump($array_props);
        
        //$error = null;
        //return array('error' => $error);
        
        return new Response(json_encode($array_props));
        
    }
    
}
