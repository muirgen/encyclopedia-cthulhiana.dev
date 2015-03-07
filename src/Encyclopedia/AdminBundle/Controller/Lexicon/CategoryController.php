<?php
namespace Encyclopedia\AdminBundle\Controller\Lexicon;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\LexiconCategory;

/**
 * Description of CategoryController
 * All the categories from lexicon are stored in the tr_lexicon_category table.
 * @author Jenny
 * @Route("{_locale}/lexicon/category", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class CategoryController extends controller{
    
    /**
     * @Route("/index", name="_admin_lexicon_category_index")
     * @Template()
     */
    public function indexAction(){
       
        return array();
        
    }
    
    /**
     * @Route("/new", name="_admin_lexicon_category_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function newAction(){
       
        $category = new LexiconCategory();
        $form = $this->lexiconCategoryCreateForm($category, 'Create');
        
        return array('form' => $form->createView());
        
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_lexicon_category_edit")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function editAction(){
       
        $category = new LexiconCategory();
        $form = $this->lexiconCategoryCreateForm($category, 'Create');
        
        return array('form' => $form->createView());
        
    }
    
    /**
     * @Route("/create", name="_admin_lexicon_category_create")
     * @Route("/update/{id}", name="_admin_lexicon_category_update")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function updateAction(){
       
        $category = new LexiconCategory();
        $form = $this->lexiconCategoryCreateForm($category, 'Create');
        
        return array('form' => $form->createView());
        
    }
     /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function lexiconCategoryCreateForm(LexiconCategory $entity, $labelBtn){
        
        $urlAction = $this->generateUrl('_admin_lexicon_category_create');
        $refId = $entity->getId();
        if($refId){
           $urlAction = $this->generateUrl('_admin_lexicon_category_update', array('id' => $refId)); 
        }
        
        $form = $this->createForm(new LexiconCategoryType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $labelBtn));
        
        return $form;
        
    }
    
}
