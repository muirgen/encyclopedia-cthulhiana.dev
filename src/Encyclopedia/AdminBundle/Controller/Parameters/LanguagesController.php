<?php
namespace Encyclopedia\AdminBundle\Controller\Parameters;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;




/**
 * Description of LanguagesController
 *
 * @author Vlad
 * @Route("{_locale}/parameters/languages", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class LanguagesController extends Controller {
    
    /**
     * @Route("/index", name="_admin_parameters_languages_index")
     * @Template()
     */
    public function indexAction(){
        
        return array();
        
    }
    
}
