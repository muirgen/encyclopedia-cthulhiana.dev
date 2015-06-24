<?php

namespace Encyclopedia\AdminBundle\Controller\Lexicon;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\LexiconCategory;
use Encyclopedia\LibraryBundle\Form\LexiconCategoryType;

use Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory;
use Encyclopedia\LibraryBundle\Form\TranslationLexiconCategoryType;

/**
 * Description of CategoryController
 * All the categories from lexicon are stored in the tr_lexicon_category table.
 * @author Jenny
 * @Route("{_locale}/lexicon/category", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class CategoryController extends controller {

    /**
     * @Route("/index", name="_admin_lexicon_category_index")
     * @Template()
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('Encyclopedia\LibraryBundle\Entity\LexiconCategory')->findAll();
        
        return array('list' => $list);
    }

    /**
     * @Route("/new", name="_admin_lexicon_category_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function newAction() {

        $category = new LexiconCategory();
        $form = $this->lexiconCategoryCreateForm($category, 'Create');

        return array('form' => $form->createView(),
            'nameOfAction' => 'New',
            'category' => $category);
    }

    /**
     * @Route("/edit/{id}", name="_admin_lexicon_category_edit")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('EncyclopediaLibraryBundle:LexiconCategory')->find($id);
        $form = $this->lexiconCategoryCreateForm($category, 'Save');

        return array('form' => $form->createView(),
            'nameOfAction' => 'Edit',
            'category' => $category);
    }

    /**
     * @Route("/create", name="_admin_lexicon_category_create")
     * @Route("/update/{id}", name="_admin_lexicon_category_update")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:edit.html.twig")
     */
    public function updateAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        if (!$id) {
            $category = new LexiconCategory();
            $btnForm = 'Create';
            $nameOfAction = 'New';
        } else {
            $category = $em->getRepository('EncyclopediaLibraryBundle:LexiconCategory')->findOneBy(array('id' => $id));
            $btnForm = 'Update';
            $nameOfAction = 'Edit';
        }

        $form = $this->lexiconCategoryCreateForm($category, $btnForm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();
        }
        
        /*return array('form' => $form->createView(),
            'nameOfAction' => $nameOfAction,
            'category' => $category);*/
        return $this->redirect($this->generateUrl('_admin_lexicon_category_edit', array('id' => $category->getId())));
    }

    /**
    * @Route("/delete/{id}", name="_admin_lexicon_category_delete")
    * @Method("GET")
    * @Template("EncyclopediaAdminBundle:Lexicon/Catetory:error.html.twig")
    */
    public function deleteAction($id) {

        $from_url = $this->getRequest()->headers->get('referer');
        $error = null;
        
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('EncyclopediaLibraryBundle:LexiconCategory')->find($id);
        
        if($category ){
            
            $em->remove($category);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_lexicon_category_edit', array('id' => $id)));
        }
        else{
            
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete action can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        return array('error' => $error);

    }
    
    /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function lexiconCategoryCreateForm(LexiconCategory $entity, $labelBtn) {

        $urlAction = $this->generateUrl('_admin_lexicon_category_create');
        $refId = $entity->getId();
        if ($refId) {
            $urlAction = $this->generateUrl('_admin_lexicon_category_update', array('id' => $refId));
        }

        $form = $this->createForm(new LexiconCategoryType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $labelBtn));

        return $form;
    }

    /**
     * Translation section.
     * Manage translation for LexiconCategory
     **/
    
    /**
     * @Route("/translation/new/id_category/{id_category}", name="_admin_translation_lexicon_category_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:translation.html.twig")
     */
    public function translationNewAction($id_category) {

        $translation = new TranslationLexiconCategory();
        $form = $this->translationLexiconCategoryCreateForm($translation, $id_category ,'Create');

        return array('form' => $form->createView(),
            'nameOfAction' => 'New',
            'translation' => $translation);
    }
    
    /**
     * @Route("/translation/edit/{id}", name="_admin_translation_lexicon_category_edit")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:translation.html.twig")
     */
    public function translationEditAction($id) {

        $em = $this->getDoctrine()->getManager();
        $translation = $em->getRepository('EncyclopediaLibraryBundle:TranslationLexiconCategory')->find($id);
        
        if(!$translation){
           throw $this->createNotFoundException('Unable to find the entity of translation for modification'); 
        }
        
        $id_category = $translation->getCategory();
        
        $form = $this->translationLexiconCategoryCreateForm($translation, $id_category ,'Update');

        return array('form' => $form->createView(),
            'nameOfAction' => 'New',
            'translation' => $translation);
    }
    
    /**
     * @Route("/translation/create", name="_admin_translation_lexicon_category_create")
     * @Route("/translation/update/{id}", name="_admin_translation_lexicon_category_update")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:translation.html.twig")
     */
    public function translationUpdateAction(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        if (!$id) {
            $translation = new TranslationLexiconCategory();
            $btnForm = 'Create';
            $nameOfAction = 'New';
        } else {
            $translation = $em->getRepository('EncyclopediaLibraryBundle:TranslationLexiconCategory')->find($id);
            $btnForm = 'Update';
            $nameOfAction = 'Edit';
        }
        
        $formData = $request->request->get('encyclopedia_librarybundle_translationlexiconcategory');
 
        $idCategory = $formData['category'];
        $category = $em->getRepository('EncyclopediaLibraryBundle:LexiconCategory')->find($idCategory);

        if(!$category){
            throw $this->createNotFoundException('Error on parent category');
        }
        
        $form = $this->translationLexiconCategoryCreateForm($translation, $category->getId() ,$btnForm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($translation);
            $em->flush();
        }
        
        return array('form' => $form->createView(),
            'nameOfAction' => $nameOfAction,
            'translation' => $translation);
        
    }
    
    /**
     * @Route("/translation/delete/{id}", name="_admin_translation_lexicon_category_delete")
     * @Template("EncyclopediaAdminBundle:Lexicon/Category:error.html.twig")
     */
    public function translationDeleteAction($id) {

        $from_url = $this->getRequest()->headers->get('referer');
        $error = null;
        
        $em = $this->getDoctrine()->getManager();
        $translation = $em->getRepository('EncyclopediaLibraryBundle:TranslationLexiconCategory')->find($id);
        
        if($translation){
            
            $em->remove($translation);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_lexicon_category_edit', array('id' => $id)));
        }
        else{
            
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete action can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        return array('error' => $error);
    }
    
    /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function translationLexiconCategoryCreateForm(TranslationLexiconCategory $entity, $idCategory, $labelBtn) {

        $urlAction = $this->generateUrl('_admin_translation_lexicon_category_create');
        $refId = $entity->getId();
        if ($refId) {
            $urlAction = $this->generateUrl('_admin_translation_lexicon_category_update', array('id' => $refId));
        }
        
        $category = $this->getDoctrine()->getManager()->getRepository('EncyclopediaLibraryBundle:LexiconCategory')->find($idCategory);
        $entity->setCategory($category);
        
        $form = $this->createForm(new TranslationLexiconCategoryType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => $labelBtn));

        return $form;
    }

    
}
