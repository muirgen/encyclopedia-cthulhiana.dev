<?php

namespace Encyclopedia\FrontBundle\Controller\Lexicon;

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
 * @Route("{_locale}/lexicon", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"})
 */
class IndexController extends Controller {
    
    /**
     * @Route("/index-{letter}", name="_lexicon", defaults={"letter" = "A"})
     * @Route("/"), name="_lexicon"
     * @Template("EncyclopediaFrontBundle:Lexicon:index.html.twig")
     */
    public function indexAction($letter = 'A', $_locale) {

        $idLocale = $this->get('kernel.listener.languages')->getIdLanguage();
        $isoCode = $_locale;

        $em = $this->getDoctrine()->getManager();

        $listCategories = $em->getRepository('EncyclopediaLibraryBundle:TranslationLexiconCategory')->findAllByIdLocale($idLocale);

        $lastEntries = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')
                ->findAllWithLimit(15);
        
        $items = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')->findByNameFirstLetterLike($letter,$isoCode);

        return array('listCategories' => $listCategories,
                    'lastEntries' => $lastEntries,
                    'items' => $items,
                    'currentLetter' => $letter);
    }

    /**
     * @Route("/autocomplete-search", name="_lexicon_autocomplete_search")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Lexicon/Index:error.html.twig")
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
