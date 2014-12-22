<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Form\CataloguesType;
use Encyclopedia\LibraryBundle\Entity\Catalogues;

use Encyclopedia\LibraryBundle\Form\CataloguesArticlesType;
use Encyclopedia\LibraryBundle\Entity\CataloguesArticles;

use Encyclopedia\LibraryBundle\Entity\CataloguesTrans;

/**
 * Description of CataloguesController
 *
 * @author Jenny
 *
 * @Route("/catalogues")
 */
class CataloguesController extends Controller {

    /**
     * @Route("/", name="_admin_catalogues")
     * @Template()
     */
    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        $lastEntries = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')
                ->findAllWithLimit(15);
        
        return array('lastentries' => $lastEntries);
    }
    
    /**************************************************
     * CREATE ENTITY
     **************************************************/
    
    /**
    * Creates a form to create a Catalogue entity.
    * @param Catalogue $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesCreateForm(Catalogues $entity){
        
        $form = $this->createForm(new CataloguesType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
        
    /**
     * @Route("/new", name="_admin_catalogues_new")
     * @Template("EncyclopediaAdminBundle:Catalogues:edit.html.twig")
     */
    public function newAction() {
        
        $entity = new Catalogues();
        
        $form = $this->cataloguesCreateForm($entity);
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/create", name="_admin_catalogues_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:edit.html.twig")
     */
    public function createAction(Request $request) {

        $entity = new Catalogues();
        
        $form = $this->cataloguesCreateForm($entity);
        
        $form->handleRequest($request);

        //Check if value of idx_name (Indexed name) is empty. If it's empty fill up with the value of name.
        $idxName = $form->getData()->getIdxName();
        
        if( empty($idxName) ){
            $name = $form->getData()->getName();
            $form->getData()->setIdxName($name);
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $entity->getId())));
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
    * Creates a form to edit a Catalogue entity.
    * @param Catalogue $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesEditForm(Catalogues $entity)
    {
        $form = $this->createForm(new CataloguesType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_catalogues_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues entity.');
        }
        
        $form = $this->cataloguesEditForm($entity);

        //List of iso_code available for countries in database, to locate the translation in the min form
        $countries = $em->getRepository('EncyclopediaLibraryBundle:Lang')->findAll();
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'countries'   => $countries,
        );
    }

    /**
     * @Route("/update/{id}", name="_admin_catalogues_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues entity.');
        }
        
        $form = $this->cataloguesEditForm($entity);

        $form->handleRequest($request);
        
        //Check if value of idx_name (Indexed name) is empty. If it's empty fill up with the value of name.
        $idxName = $form->getData()->getIdxName();
        
        if( empty($idxName) ){   
            $name = $form->getData()->getName();
            $form->getData()->setIdxName($name); 
        }
        
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id)));
        }

        //List of iso_code available for countries in database, to locate the translation in the min form
        $countries = $em->getRepository('EncyclopediaLibraryBundle:Lang')->findAll();
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'countries'   => $countries
        );
    }
    
    /**************************************************
     * TRANSLATION MANAGEMENT FOR CATALOGUES ENTITY
     **************************************************/
    
    /**
     * @Route("/translation/{id}/create", name="_admin_catalogues_translation_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function createCataloguesTranslationAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $error = null;
        
        $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id);
        
        $isoCode = $request->get('isoCode');
        $nameTrans = $request->get('nameTrans');
        $idxNameTrans = $request->get('idxNameTrans');
        
        $translation = new CataloguesTrans();
        $translation->setCatalogues($catalogue);
        $translation->setIsocode($isoCode);
        $translation->setNameTrans($nameTrans);
        
        //Check if value of idx_name (Indexed name) is empty. If it's empty fill up with the value of name.       
        if( empty($idxNameTrans) ){    
            $translation->setIdxNameTrans($nameTrans);          
        }

        try {
            $em->persist($translation);
            $em->flush();
            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id)));
        } catch (\Exception $e) {
            $from_url = $this->getRequest()->headers->get('referer');
            $error = '<i class="fa fa-exclamation-triangle"></i>Error during the creation process, correct the entry and try again<br/><p>'.$e->getMessage().'</p><br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        return array('error' => $error);
        
    }
    
    /**
     * @Route("/translation/{id}/update", name="_admin_catalogues_translation_update")
     * @Route("/translation/{id}/update/{idx}", name="_admin_catalogues_translation_update_idx")
     * @Method("POST")
     */
    public function updateCataloguesTranslationAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $element_id = $request->get('element_id');
        $new_value = $request->get('update_value');
        
        $translation = $em->getRepository('EncyclopediaLibraryBundle:CataloguesTrans')->find($element_id);
        
        if($translation){
            
            if(!$request->get('idx')){
                $translation->setNameTrans($new_value);
            }
            else{
                $translation->setIdxNameTrans($new_value);
            }
            
            $em->persist($translation);
            $em->flush();
            
        }
        
        return new Response($new_value);
    }
    
    /**
     * @Route("/translation/{id}/delete/{id_translation}", name="_admin_catalogues_translation_delete")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function deleteCataloguesTranslationAction(Request $request, $id, $id_translation){
        
        $em = $this->getDoctrine()->getManager();
        $from_url = $this->getRequest()->headers->get('referer');
        $error = null;
        
        $translation = $em->getRepository('EncyclopediaLibraryBundle:CataloguesTrans')->find($id_translation);
        
        if($translation ){
            
            $em->remove($translation);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id)));
        }
        else{
            
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete action can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        return array('error' => $error);
    }
    
    /**************************************************
     * ADD AND DELETE A RELATED ITEM
     **************************************************/
    
    /**
     * @Route("/{idcatalogue}/addrelated", name="_admin_catalogues_addrelated")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function addRelatedAction(Request $request, $idcatalogue){
        
        $error = null;
        $idrelated = $request->request->get('id_related');
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        
        $entityCatalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($idcatalogue);
        $entityRelated = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($idrelated);
        
        if($entityCatalogue->getRelatedItems()->contains($idrelated) AND $entityRelated->getRelatedItems()->contains($idcatalogue)){
            $error = '<i class="fa fa-exclamation-triangle"></i> This catalogue item is already attached on related<br/><i class="fa fa-exclamation-triangle"></i> Try another one<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            
            $entityCatalogue->addRelatedItems($entityRelated);
            $entityRelated->addRelatedItems($entityCatalogue);
            
            $em->persist($entityCatalogue);
            $em->persist($entityRelated);
            
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $idcatalogue)));
            
        }
        
        return array('error' => $error);
        
    }
    
    /**
     * @Route("/{idcatalogue}/delrelated/{idrelated}", name="_admin_catalogues_delrelated")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function delRelatedAction(Request $request, $idcatalogue, $idrelated){
      
        $error = null;
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        $entityCatalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($idcatalogue);
        $entityRelated = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($idrelated);
        
        if(!$entityCatalogue OR !$entityRelated){
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            
            $entityCatalogue->removeRelatedItems($entityRelated);
            $entityRelated->removeRelatedItems($entityCatalogue);
            
            $em->persist($entityCatalogue);
            $em->persist($entityRelated);
            
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $idcatalogue)));
        }
        
        return array('error' => $error);
    }
    
    /**************************************************
     * ADD AND DELETE AN OEUVRE ATTACHED TO AN ITEM
     **************************************************/
    
    /**
     * @Route("/{id}/addoeuvre", name="_admin_catalogues_addoeuvre")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function addOeuvreAction(Request $request, $id){
        
        $error = null;
        $id_oeuvre = $request->request->get('id_oeuvre');
        $firstAppearance = $request->request->get('firstappearance');
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesOeuvres')->findOneBy(array('catalogues' => $id, 'oeuvres' => $id_oeuvre));
        
        if($entity){
            $error = '<i class="fa fa-exclamation-triangle"></i> This catalogue item is already attached to the selected oeuvre<br/><i class="fa fa-exclamation-triangle"></i> Try another one<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            
            $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id);
            $oeuvre = $em->getRepository('EncyclopediaLibraryBundle:Oeuvres')->find($id_oeuvre);
            
            $entity = new \Encyclopedia\LibraryBundle\Entity\CataloguesOeuvres();
            $entity->setCatalogues($catalogue);
            $entity->setOeuvres($oeuvre);
            $entity->setFirstAppearance($firstAppearance);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id)));
            
        }
        
        return array('error' => $error);
        
    }
    
    /**
     * @Route("/{id}/deloeuvre/{idoeuvre}", name="_admin_catalogues_deloeuvre")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function delOeuvreAction(Request $request, $id, $idoeuvre){
      
        $error = null;
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesOeuvres')->findOneBy(array('catalogues' => $id, 'oeuvres' => $idoeuvre));
        
        if(!$entity){
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            $em->remove($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id)));
        }
        
        return array('error' => $error);
    }
    
    /**************************************************
     * SEARCH FOR ENTITY
     **************************************************/
    
    /**
     * @Route("/autocomplete-search", name="_admin_catalogues_autocomplete_search")
     * @Method("GET")
     */
    public function autocompleteSearchAction(Request $request) {

        $termSearch = $request->query->get('catalogue');
        $id_catalogue = $request->query->get('id_catalogue');
        $action = $request->query->get('action');

        $em = $this->getDoctrine()->getManager();
        
        if($action == 'addrelateditem'){
            $props = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')
                    ->findByAutocompleteWithAliasExceptIdCatalogue($termSearch, $id_catalogue);
        }
        else{
            $props = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')
                    ->findByAutocompleteWithAlias($termSearch);
        }
        
        $array_props = array();

        foreach ($props as $key => $p):
            $array_props[$key + 1] = array('id' => $p['ca_id'], 'name' => $p['ca_name']);
        endforeach;

        return new Response(json_encode($array_props));
    }

    /**
     * @Route("/search", name="_admin_catalogues_search")
     * @Method("POST")
     */
    public function searchAction(Request $request) {

        $id_catalogue = $request->request->get('id_catalogue');

        /**
         * if $id_catalogue is referenced in the form submitted (choice of item inside the autocomplete list)
         * Redirect to the edit form for the id.
         */
        if ($id_catalogue) {
            return $this->redirect($this->generateUrl('_admin_catalogues_edit', array('id' => $id_catalogue)));
        }

        /**
         * if $id_catalogue not referenced, so display a list of proposal choice from the database
         * related with the input value submited
         */
        return new Response('search');
    }
    
}
