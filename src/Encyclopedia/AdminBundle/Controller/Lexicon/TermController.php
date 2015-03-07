<?php
namespace Encyclopedia\AdminBundle\Controller\Lexicon;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\Lexicon;

/**
 * Description of TermController
 * All the terms from lexicon are stored in the tr_lexicon table.
 * @author Jenny
 * @Route("{_locale}/lexicon/term", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class TermController extends controller{

    /**
     * @Route("/index", name="_admin_lexicon_term_index")
     * @Template()
     */
    public function indexAction(){
       
        return array();
        
    }
    
    /**
     * @Route("/new", name="_admin_lexicon_term_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/Term:edit.html.twig")
     */
    public function newAction(){
        
        $term = new Lexicon();
        //$form = $this->languageCreateForm($language, 'Create');
        
        //return array('form' => $form->createView());
        
        return array();
    }
    
    
}
