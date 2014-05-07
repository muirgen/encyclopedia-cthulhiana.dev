<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Encyclopedia\AdminBundle\Form\CatalogueType;

/**
 * Description of CatalogueController
 *
 * @author Jenny
 *
 * @Route("/catalogue")
 */
class CatalogueController extends Controller {

    /**
     * @Route("/", name="_catalogue")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $lastEntries = $em->getRepository('EncyclopediaAdminBundle:Catalogue')
                ->findAllWithLimit(15);
        
        return $this->render('EncyclopediaAdminBundle:Catalogue:index.html.twig',array('lastentries' => $lastEntries));
    }
    
    /**
     * @Route("/edit/{id}", name="_catalogue_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Catalogue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
        }
        
        $form = $this->createForm(new CatalogueType(), $entity, array(
            'action' => $this->generateUrl('_catalogue_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/update/{id}", name="_catalogue_update")
     * @Method("GET")
     * @Template("EncyclopediaAdminBundle:Catalogue:edit.html.twig")
     */
    public function updateAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Catalogue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
        }
        
        $form = $this->createForm(new CatalogueType(), $entity, array(
            'action' => $this->generateUrl('_catalogue_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogue_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/autocomplete-search", name="_catalogue_autocomplete_search")
     * @Method("GET")
     */
    public function autocompleteSearchAction(Request $request) {

        $termSearch = $request->query->get('catalogue');

        $em = $this->getDoctrine()->getManager();
        $props = $em->getRepository('EncyclopediaAdminBundle:Catalogue')
                ->findByAutocompleteWithAlias($termSearch);

        $array_props = array();

        foreach ($props as $key => $p):
            $array_props[$key + 1] = array('id' => $p['ca_id'], 'name' => $p['ca_name']);
        endforeach;

        return new Response(json_encode($array_props));
    }

    /**
     * @Route("/search", name="_catalogue_search")
     * @Method("POST")
     */
    public function searchAction(Request $request) {

        $id_catalogue = $request->request->get('id_catalogue');

        /**
         * if $id_catalogue is referenced in the form submitted (choice of item inside the autocomplete list)
         * Redirect to the edit form for the id.
         */
        if ($id_catalogue) {
            return $this->redirect($this->generateUrl('_catalogue_edit', array('id' => $id_catalogue)));
        }

        /**
         * if $id_catalogue not referenced, so display a list of proposal choice from the database
         * related with the input value submited
         */
        return new Response('search');
    }

}
