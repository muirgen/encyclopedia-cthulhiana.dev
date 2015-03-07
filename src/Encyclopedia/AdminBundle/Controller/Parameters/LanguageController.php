<?php
namespace Encyclopedia\AdminBundle\Controller\Parameters;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\Language;
use Encyclopedia\LibraryBundle\Form\LanguageType;


/**
 * Description of LanguagesController
 *
 * @author Vlad
 * @Route("{_locale}/parameters/languages", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class LanguageController extends Controller {
    
    /**
     * @Route("/index", name="_admin_parameters_languages_index")
     * @Template()
     */
    public function indexAction(){
        
        $em = $this->getDoctrine()->getManager();
        
        $publicLanguage = $em->getRepository('EncyclopediaLibraryBundle:Language')->findBy(array('public' => 1));

        $lexiconLanguage = $em->getRepository('EncyclopediaLibraryBundle:Language')->findAll();
        
        return array('publicLanguage' => $publicLanguage,
                        'lexiconLanguage' => $lexiconLanguage);
        
    }    
    
    /**
     * @Route("/new", name="_admin_parameters_languages_new")
     * @Template("EncyclopediaAdminBundle:Parameters/Language:edit.html.twig")
     */
    public function newAction(){
        
        $language = new Language();
        $language->setPublic(false);
        $form = $this->languageCreateForm($language, 'Create');
        
        return array('form' => $form->createView());
        
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_parameters_languages_edit")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Parameters/Language:edit.html.twig")
     */
    public function editAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $language = $em->getRepository('EncyclopediaLibraryBundle:Language')->find($id);
        
        if (!$language) {
            throw $this->createNotFoundException('Unable to find Language entity.');
        }
        
        $form = $this->languageCreateForm($language, 'Update');
        
        return array('form' => $form->createView());
        
    }
    
    /**
     * @Route("/create", name="_admin_parameters_languages_create")
     * @Route("/update/{id}", name="_admin_parameters_languages_update")
     * @Template("EncyclopediaAdminBundle:Parameters/Language:edit.html.twig")
     */
    public function updateAction(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        
        $id = $request->get('id');

            if(!$id){
                $language = new Language();
                $btnForm = 'Create';
            }
            else{
                $language = $em->getRepository('EncyclopediaLibraryBundle:Language')->findOneBy(array('id' => $id));
                $btnForm = 'Update';
                
            }

        $form = $this->languageCreateForm($language, $btnForm);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em->persist($language);
            $em->flush();
        }
        return array('form' => $form->createView());
        
    }
    
    /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function languageCreateForm(Language $entity, $labelBtn){
        
        $urlAction = $this->generateUrl('_admin_parameters_languages_create');
        $refId = $entity->getId();
        if($refId){
           $urlAction = $this->generateUrl('_admin_parameters_languages_update', array('id' => $refId)); 
        }
        
        $form = $this->createForm(new languageType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $labelBtn));
        
        return $form;
        
    }
}
