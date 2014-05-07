<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of IndexController
 *
 * @author Jenny
 *
 * @Route("/index")
 */
class IndexController extends Controller{
    
    /**
     * @Route("/", name="_index")
     */
    public function indexAction(){
        
         return $this->render('EncyclopediaAdminBundle:Index:index.html.twig');
        
    }
    
    /**
     * @Route("/search", name="_index_search")
     * @Method("POST")
     */
    public function searchAction(){
        
        $test = array(1 => array('id' => 1, 'name' => 'Dagon'));
        
        return new Response(json_encode($test));
        
    }
    
    
}
