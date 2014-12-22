<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\LibraryBundle\Form\CataloguesAliasType;
use Encyclopedia\LibraryBundle\Entity\CataloguesAlias;

use Encyclopedia\LibraryBundle\Form\CataloguesAliasTransType;
use Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans;

/**
 * Description of CataloguesAliasController
 *
 * @author Jenny
 *
 * @Route("/catalogues/{id_catalogue}/alias")
 */
class CataloguesAliasController extends Controller {
    
    /**************************************************
     * CREATE ENTITY
     ************************************************* */

    /**
     * Creates a form to create a CatalogueAlias entity.
     * @param CataloguesAlias $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function cataloguesAliasCreateForm(CataloguesAlias $entity, $id_catalogue) {

        $form = $this->createForm(new CataloguesAliasType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_alias_create',array('id_catalogue' => $id_catalogue)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/new", name="_admin_catalogues_alias_new")
     * @Template("EncyclopediaAdminBundle:CataloguesAlias:edit.html.twig")
     */
    public function newAction($id_catalogue) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id_catalogue);
        
        $entity = new CataloguesAlias();
        $entity->setCatalogues($catalogue);
     
        $form = $this->cataloguesAliasCreateForm($entity,$id_catalogue);
        
        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/create", name="_admin_catalogues_alias_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesAlias:edit.html.twig")
     */
    public function createAction(Request $request, $id_catalogue) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id_catalogue);
        
        $entity = new CataloguesAlias();
        
        $form = $this->cataloguesAliasCreateForm($entity, $id_catalogue);
        
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

            return $this->redirect($this->generateUrl('_admin_catalogues_alias_edit', array('id_catalogue' => $id_catalogue, 'id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'catalogue' => $catalogue,
            'edit_form'   => $form->createView(),
        );
    }

    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
    * Creates a form to edit a CataloguesAlias entity.
    * @param CataloguesAlias $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesAliasEditForm(CataloguesAlias $entity, $id_catalogue)
    {
        $form = $this->createForm(new CataloguesAliasType(), $entity, array(
            'action' => $this->generateUrl('_admin_catalogues_alias_update', array('id' => $entity->getId(),'id_catalogue' => $id_catalogue)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}/", name="_admin_catalogues_alias_edit")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:CataloguesAlias:edit.html.twig")
     */
    public function editAction($id_catalogue, $id) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id_catalogue);
        
        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues Alias entity.');
        }
        
        $form = $this->cataloguesAliasEditForm($entity, $id_catalogue);
        
        //List of iso_code available for countries in database, to locate the translation in the min form
        $countries = $em->getRepository('EncyclopediaLibraryBundle:Lang')->findAll();
        
        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView(),
            'countries'   => $countries,
        );
    }

    /**
     * @Route("/update/{id}", name="_admin_catalogues_alias_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesAlias:edit.html.twig")
     */
    public function updateAction(Request $request, $id_catalogue, $id){
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaLibraryBundle:Catalogues')->find($id_catalogue);
        
        $entity = $em->getRepository('EncyclopediaLibraryBundle:CataloguesAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues Alias entity.');
        }
        
        $form = $this->cataloguesAliasEditForm($entity, $id_catalogue);

        $form->handleRequest($request);

        //Check if value of idx_name (Indexed name) is empty. If it's empty fill up with the value of name.
        $idxName = $form->getData()->getIdxName();
        
        if( empty($idxName) ){
            $name = $form->getData()->getName();
            $form->getData()->setIdxName($name);
        }
        
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_catalogues_alias_edit', array('id' => $id, 'id_catalogue' => $id_catalogue)));
        }

        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView()
        );
    }
    
    /**************************************************
     * TRANSLATION MANAGEMENT FOR CATALOGUES ALIAS ENTITY
     **************************************************/
    
    /**
     * @Route("/translation/{id}/create", name="_admin_catalogues_alias_translation_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function createCataloguesAliasTranslationAction(Request $request, $id_catalogue, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $error = null;
        
        $alias = $em->getRepository('EncyclopediaLibraryBundle:CataloguesAlias')->find($id);
        
        $isoCode = $request->get('isoCode');
        $nameTrans = $request->get('nameTrans');
        $idxNameTrans = $request->get('idxNameTrans');
        
        $translation = new CataloguesAliasTrans();
        $translation->setCatalogues($alias);
        $translation->setIsocode($isoCode);
        $translation->setNameTrans($nameTrans);
        
        //Check if value of idx_name (Indexed name) is empty. If it's empty fill up with the value of name.       
        if( empty($idxNameTrans) ){    
            $translation->setIdxNameTrans($nameTrans);          
        }

        try {
            $em->persist($translation);
            $em->flush();
            return $this->redirect($this->generateUrl('_admin_catalogues_alias_edit', array('id_catalogue' => $id_catalogue, 'id' => $id)));
        } catch (\Exception $e) {
            $from_url = $this->getRequest()->headers->get('referer');
            $error = '<i class="fa fa-exclamation-triangle"></i>Error during the creation process, correct the entry and try again<br/><p>'.$e->getMessage().'</p><br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        return array('error' => $error);
        
    }
    
    /**
     * @Route("/translation/{id}/update", name="_admin_catalogues_alias_translation_update")
     * @Route("/translation/{id}/update/{idx}", name="_admin_catalogues_alias_translation_update_idx")
     * @Method("POST")
     */
    public function updateCataloguesAliasTranslationAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $element_id = $request->get('element_id');
        $new_value = $request->get('update_value');
        
        $translation = $em->getRepository('EncyclopediaLibraryBundle:CataloguesAliasTrans')->find($element_id);
        
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
     * @Route("/translation/{id}/delete/{id_translation}", name="_admin_catalogues_alias_translation_delete")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function deleteCataloguesTranslationAction(Request $request, $id_catalogue, $id, $id_translation){
        
        $em = $this->getDoctrine()->getManager();
        $from_url = $this->getRequest()->headers->get('referer');
        $error = null;
        
        $translation = $em->getRepository('EncyclopediaLibraryBundle:CataloguesAliasTrans')->find($id_translation);
        
        if($translation ){
            
            $em->remove($translation);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_admin_catalogues_alias_edit', array('id_catalogue' => $id_catalogue, 'id' => $id)));
        }
        else{
            
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete action can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        return array('error' => $error);
    }
}
