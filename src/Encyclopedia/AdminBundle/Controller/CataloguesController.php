<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\AdminBundle\Form\CataloguesType;
use Encyclopedia\AdminBundle\Entity\Catalogues;

/**
 * Description of CataloguesController
 *
 * @author Jenny
 *
 * @Route("/catalogues")
 */
class CataloguesController extends Controller {

    /**
     * @Route("/", name="_catalogues")
     * @Template()
     */
    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        $lastEntries = $em->getRepository('EncyclopediaAdminBundle:Catalogues')
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
            'action' => $this->generateUrl('_catalogues_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
        
    /**
     * @Route("/new", name="_catalogues_new")
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
     * @Route("/create", name="_catalogues_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:edit.html.twig")
     */
    public function createAction(Request $request) {

        $entity = new Catalogues();
        
        $form = $this->cataloguesCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogues_edit', array('id' => $entity->getId())));
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
            'action' => $this->generateUrl('_catalogues_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}", name="_catalogues_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues entity.');
        }
        
        $form = $this->cataloguesEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/update/{id}", name="_catalogues_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogues entity.');
        }
        
        $form = $this->cataloguesEditForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogues_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
    /**************************************************
     * SEARCH FOR ENTITY
     **************************************************/
    
    /**
     * @Route("/autocomplete-search", name="_catalogues_autocomplete_search")
     * @Method("GET")
     */
    public function autocompleteSearchAction(Request $request) {

        $termSearch = $request->query->get('catalogue');

        $em = $this->getDoctrine()->getManager();
        $props = $em->getRepository('EncyclopediaAdminBundle:Catalogues')
                ->findByAutocompleteWithAlias($termSearch);

        $array_props = array();

        foreach ($props as $key => $p):
            $array_props[$key + 1] = array('id' => $p['ca_id'], 'name' => $p['ca_name']);
        endforeach;

        return new Response(json_encode($array_props));
    }

    /**
     * @Route("/search", name="_catalogues_search")
     * @Method("POST")
     */
    public function searchAction(Request $request) {

        $id_catalogue = $request->request->get('id_catalogue');

        /**
         * if $id_catalogue is referenced in the form submitted (choice of item inside the autocomplete list)
         * Redirect to the edit form for the id.
         */
        if ($id_catalogue) {
            return $this->redirect($this->generateUrl('_catalogues_edit', array('id' => $id_catalogue)));
        }

        /**
         * if $id_catalogue not referenced, so display a list of proposal choice from the database
         * related with the input value submited
         */
        return new Response('search');
    }
    
    /**************************************************
     * Add and delete an oeuvre attached to an item
     **************************************************/
    
    /**
     * @Route("/{id}/addoeuvre", name="_catalogues_addoeuvre")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function addOeuvreAction(Request $request, $id){
        
        $error = null;
        $id_oeuvre = $request->request->get('id_oeuvre');
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EncyclopediaAdminBundle:CataloguesOeuvres')->findOneBy(array('catalogues' => $id, 'oeuvres' => $id_oeuvre));
        
        if($entity){
            $error = '<i class="fa fa-exclamation-triangle"></i> This catalogue item is already attached to the selected oeuvre<br/><i class="fa fa-exclamation-triangle"></i> Try another one<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            
            $catalogue = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id);
            $oeuvre = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id_oeuvre);
            
            $entity = new \Encyclopedia\AdminBundle\Entity\CataloguesOeuvres();
            $entity->setCatalogues($catalogue);
            $entity->setOeuvres($oeuvre);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogues_edit', array('id' => $id)));
            
        }
        
        return array('error' => $error);
        
    }
    
    /**
     * @Route("/{id}/deloeuvre/{idoeuvre}", name="_catalogues_deloeuvre")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogues:error.html.twig")
     */
    public function delOeuvreAction(Request $request, $id, $idoeuvre){
      
        $error = null;
        $from_url = $this->getRequest()->headers->get('referer');
                
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EncyclopediaAdminBundle:CataloguesOeuvres')->findOneBy(array('catalogues' => $id, 'oeuvres' => $idoeuvre));
        
        if(!$entity){
            $error = '<i class="fa fa-exclamation-triangle"></i> The selected items are not registered, and the delete can\'t go further<br/><a href="'.$from_url.'">Back to the item</a>';
        }
        
        else{
            $em->remove($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('_catalogues_edit', array('id' => $id)));
        }
        
        return array('error' => $error);
    }
    
    
}
