<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\AdminBundle\Form\OeuvresType;
use Encyclopedia\AdminBundle\Entity\Oeuvres;

/**
 * Description of OeuvresController
 *
 * @author Jenny
 *
 * @Route("/oeuvres")
 */
class OeuvresController extends Controller{
    
    /**
     * @Route("/", name="_oeuvres")
     * @Template()
     */
    public function indexAction(){
        
        $em = $this->getDoctrine()->getManager();
        $lastentries = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')
                ->findAllWithLimit(15);
        
        return array('lastentries' => $lastentries);
    }
    
    /**************************************************
     * CREATE ENTITY
     **************************************************/
    
    /**
    * Creates a form to create a Oeuvre entity.
    * @param Oeuvre $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function oeuvresCreateForm(Oeuvres $entity){
        
        $form = $this->createForm(new OeuvresType(), $entity, array(
            'action' => $this->generateUrl('_oeuvres_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/new", name="_oeuvres_new")
     * @Template("EncyclopediaAdminBundle:Oeuvres:edit.html.twig")
     */
    public function newAction(){
        
        $entity = new Oeuvres();
        
        $form = $this->oeuvresCreateForm($entity);
        
        return array('entity' => $entity,
                    'edit_form' => $form->createView());
        
    }
    
    /**
     * @Route("/create", name="_oeuvres_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Oeuvres:edit.html.twig")
     */
    public function createAction(Request $request) {

        $entity = new Oeuvres();
        
        $form = $this->oeuvresCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_oeuvres_edit', array('id' => $entity->getId())));
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
    * Creates a form to edit a Oeuvre entity.
    * @param Oeuvre $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function oeuvresEditForm(Oeuvres $entity)
    {
        $form = $this->createForm(new OeuvresType(), $entity, array(
            'action' => $this->generateUrl('_oeuvres_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
   /**
     * @Route("/edit/{id}", name="_oeuvres_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oeuvres entity.');
        }
        
        $form = $this->oeuvresEditForm($entity);
        
        //$persons = $entity->getPersons();
        //$form->get('persons')->setData($persons);

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/update/{id}", name="_oeuvres_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Oeuvres:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oeuvres entity.');
        }
        
        $form = $this->oeuvresEditForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            /* gets all the Persons inside the form we have related to the oeuvre */
            $relatedPersons = $entity->getPersons();
            
            /* Do a loop on it to persist the collection */
            foreach($relatedPersons as $p){
                $em->persist($p);
            }
            
            /* And flush every thing */
            $em->flush();

            return $this->redirect($this->generateUrl('_oeuvres_edit', array('id' => $id)));
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
     * @Route("/autocomplete-search", name="_oeuvres_autocomplete_search")
     * @Method("GET")
     */
    public function autocompleteSearchAction(Request $request) {

        $termSearch = $request->query->get('oeuvre');
        $id_catalogue = $request->query->get('id_catalogue');
        $action = $request->query->get('action');

        $em = $this->getDoctrine()->getManager();
        
        if($action == 'addcatalogueitem'){
            $props = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')
                    ->findByAutocompleteWithAliasExceptIdCatalogue($termSearch, $id_catalogue);
        }
        else{
            $props = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')
                    ->findByAutocompleteWithAlias($termSearch);
        }
        $array_props = array();

        foreach ($props as $key => $o):
            $array_props[$key + 1] = array('id' => $o['oa_id'], 'name' => $o['oa_name']);
        endforeach;

        return new Response(json_encode($array_props));
    }

    /**
     * @Route("/search", name="_oeuvres_search")
     * @Method("POST")
     */
    public function searchAction(Request $request) {

        $id_oeuvre = $request->request->get('id_oeuvre');

        /**
         * if $id_oeuvre is referenced in the form submitted (choice of item inside the autocomplete list)
         * Redirect to the edit form for the id.
         */
        if ($id_oeuvre) {
            return $this->redirect($this->generateUrl('_oeuvres_edit', array('id' => $id_oeuvre)));
        }

        /**
         * if $id_catalogue not referenced, so display a list of proposal choice from the database
         * related with the input value submited
         */
        return new Response('search');
    }
    
}
