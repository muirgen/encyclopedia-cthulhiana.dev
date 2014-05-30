<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\AdminBundle\Form\PersonsType;
use Encyclopedia\AdminBundle\Entity\Persons;

/**
 * Description of PersonsController
 *
 * @author Jenny
 *
 * @Route("/persons")
 */
class PersonsController extends Controller{
    
    /**
     * @Route("/", name="_persons")
     * @Template()
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $lastEntries = $em->getRepository('EncyclopediaAdminBundle:Persons')
                ->findAllWithLimit(15);
        
        return array('lastentries' => $lastEntries);
    }
    
    /**************************************************
     * CREATE ENTITY
     **************************************************/
    
    /**
    * Creates a form to create a Persons entity.
    * @param Persons $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function personsCreateForm(Persons $entity){
        
        $form = $this->createForm(new PersonsType(), $entity, array(
            'action' => $this->generateUrl('_persons_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/new", name="_persons_new")
     * @Template("EncyclopediaAdminBundle:Persons:edit.html.twig")
     */
    public function newAction() {
        
        $entity = new Persons();
        
        $form = $this->personsCreateForm($entity);
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/create", name="_persons_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Persons:edit.html.twig")
     */
    public function createAction(Request $request) {

        $entity = new Persons();
        
        $form = $this->personsCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_persons_edit', array('id' => $entity->getId())));
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
    * Creates a form to edit a Persons entity.
    * @param Persons $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function personsEditForm(Persons $entity)
    {
        $form = $this->createForm(new PersonsType(), $entity, array(
            'action' => $this->generateUrl('_persons_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}", name="_persons_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persons entity.');
        }
        
        $form = $this->personsEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/update/{id}", name="_persons_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Persons:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persons entity.');
        }
        
        $form = $this->personsEditForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_persons_edit', array('id' => $id)));
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
     * @Route("/autocomplete-search", name="_persons_autocomplete_search")
     * @Method("GET")
     */
    public function autocompleteSearchAction(Request $request) {

        $termSearch = $request->query->get('person');

        $em = $this->getDoctrine()->getManager();
        $props = $em->getRepository('EncyclopediaAdminBundle:Persons')
                ->findByAutocompleteWithAlias($termSearch);

        $array_props = array();

        foreach ($props as $key => $p):
            $array_props[$key + 1] = array('id' => $p['pa_id'], 'name' => $p['pa_name']);
        endforeach;

        return new Response(json_encode($array_props));
    }

    /**
     * @Route("/search", name="_persons_search")
     * @Method("POST")
     */
    public function searchAction(Request $request) {

        $id_person = $request->request->get('id_person');

        /**
         * if $id_person is referenced in the form submitted (choice of item inside the autocomplete list)
         * Redirect to the edit form for the id.
         */
        if ($id_person) {
            return $this->redirect($this->generateUrl('_persons_edit', array('id' => $id_person)));
        }

        /**
         * if $id_person not referenced, so display a list of proposal choice from the database
         * related with the input value submited
         */
        return new Response('search');
    }
}
