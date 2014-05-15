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
     */
    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        $lastEntries = $em->getRepository('EncyclopediaAdminBundle:Catalogues')
                ->findAllWithLimit(15);
        
        return $this->render('EncyclopediaAdminBundle:Catalogues:index.html.twig',array('lastentries' => $lastEntries));
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
     * @Template("EncyclopediaAdminBundle:catalogues:edit.html.twig")
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
     * @Template("EncyclopediaAdminBundle:catalogues:edit.html.twig")
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
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
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
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
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

}
