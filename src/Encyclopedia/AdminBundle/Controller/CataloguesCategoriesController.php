<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Entity\CataloguesCategories;
use Encyclopedia\LibraryBundle\Form\CataloguesCategoriesType;

use Encyclopedia\LibraryBundle\Entity\CataloguesCategoriesTrans;
use Encyclopedia\LibraryBundle\Form\CataloguesCategoriesTransType;

/**
 * Description of CataloguesController
 *
 * @author Jenny
 *
 * @Route("/catalogues-categories")
 */
class CataloguesCategoriesController extends Controller{
    
    /**
     * @Route("/", name="_admin_catalogues_categories")
     * @Template()
     */
    public function indexAction(){
        
        $list = $this->getDoctrine()->getRepository('EncyclopediaLibraryBundle:CataloguesCategories')->findAll();
        
        return array('list' => $list);
        
    }
    
    /**************************************************
     * CREATE ENTITY
     **************************************************/
    
    /**
    * Creates a form to create a CataloguesCategories entity.
    * @param CataloguesCategories $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesCategoriesCreateForm(CataloguesCategories $entity){
        
        $form = $this->createForm(new CataloguesCategoriesType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_categories_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/new", name="_admin_catalogues_categories_new")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:edit.html.twig")
     */
    public function newAction(){
        
        $entity = new CataloguesCategories();
        
        $form = $this->cataloguesCategoriesCreateForm($entity);
        
        return array('edit_form' => $form->createView(),
            'entity' => $entity);
        
    }
    
    /**
     * @Route("/create", name="_admin_catalogues_categories_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:edit.html.twig")
     */
    public function createAction(Request $request){
     
        $entity = new CataloguesCategories();
        
        $form = $this->cataloguesCategoriesCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_categories_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        );
    }
    
    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
    * Creates a form to edit a CataloguesCategories entity.
    * @param CataloguesCategories $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesCategoriesEditForm(CataloguesCategories $entity)
    {
        $form = $this->createForm(new CataloguesCategoriesType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_categories_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_catalogues_categories_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues Categories entity.');
        }
        
        $form = $this->cataloguesCategoriesEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/update/{id}", name="_admin_catalogues_categories_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues Categories entity.');
        }
        
        $form = $this->cataloguesCategoriesEditForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_categories_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
    /**********************************************************************************************************************
     * CATALOGUES CATEGORIES TRANSLATION
     **********************************************************************************************************************/
    
    /**
    * Creates a form to create a CataloguesCategories entity.
    * @param CataloguesCategories $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesCategoriesTransCreateForm(CataloguesCategoriesTrans $entity){
        
        $form = $this->createForm(new CataloguesCategoriesTransType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_categories_trans_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/translation/new/category-{id_category}", name="_admin_catalogues_categories_trans_new")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:translationedit.html.twig")
     */
    public function newTranslationAction($id_category){
        
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategories')->find($id_category);
        
        $entity = new CataloguesCategoriesTrans();
        $entity->setCategory($category);
        
        $form = $this->cataloguesCategoriesTransCreateForm($entity);
        
        return array('edit_form' => $form->createView(),
            'entity' => $entity);
        
    }
    
    /**
     * @Route("/translation/create", name="_admin_catalogues_categories_trans_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:translationedit.html.twig")
     */
    public function createTranslationAction(Request $request){
     
        $entity = new CataloguesCategoriesTrans();
        
        $form = $this->cataloguesCategoriesTransCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_categories_trans_edit', array('id_category' => $entity->getCategory()->getId(),'id_lang' => $entity->getLanguages()->getId())));
        }

        return array(
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        );
    }
    
    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
    * Creates a form to edit a CataloguesCategories entity.
    * @param CataloguesCategories $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesCategoriesTransEditForm(CataloguesCategoriesTrans $entity, $id_category, $id_lang)
    {
        $form = $this->createForm(new CataloguesCategoriesTransType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_categories_trans_update', array('id_category' => $id_category, 'id_lang' => $id_lang)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));
  
        return $form;
    }
    
    /**
     * @Route("/translation/edit/category-{id_category}/lang-{id_lang}", name="_admin_catalogues_categories_trans_edit")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:translationedit.html.twig")
     */
    public function editTranslationAction($id_category, $id_lang) {
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategoriesTrans')->findOneBy(array('category' => $id_category,'languages' => $id_lang));
      
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CataloguesCategoriesTrans entity.');
        }

        $form = $this->cataloguesCategoriesTransEditForm($entity, $id_category, $id_lang);

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/translation/update/category-{id_category}/lang-{id_lang}", name="_admin_catalogues_categories_trans_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesCategories:translationedit.html.twig")
     */
    public function updateTranslationAction(Request $request, $id_category, $id_lang){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesCategoriesTrans')->findOneBy(array('category' => $id_category,'lang' => $id_lang));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CatalogueCategoriesTrans entity.');
        }
        
        $form = $this->cataloguesCategoriesTransEditForm($entity, $id_category, $id_lang);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_categories_trans_edit', array('id_category' => $id_category, 'id_lang' => $id_lang)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
}
