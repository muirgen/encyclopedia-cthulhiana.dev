<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Encyclopedia\LibraryBundle\Entity\Publishing;
use Encyclopedia\LibraryBundle\Form\PublishingType;

/**
 * Description of PublishingController
 *
 * @author Jenny
 *
 * @Route("/publishing")
 */
class PublishingController extends Controller {

    /**
     * @Route("/", name="_admin_publishing")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EncyclopediaLibraryBundle:Publishing')->findAll();

        return $this->render('EncyclopediaAdminBundle:Publishing:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**************************************************
     * CREATE ENTITY
     **************************************************/
    
    /**
     * Creates a form to create a Publishing entity.
     *
     * @param Publishing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function publishingCreateForm(Publishing $entity) {
        $form = $this->createForm(new PublishingType(), $entity, array(
            'action' => $this->generateUrl('_admin_publishing_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    
    /**
     * @Route("/new", name="_admin_publishing_new")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function newAction() {
        
        $entity = new Publishing();
        $form = $this->publishingCreateForm($entity);

        return array(
                    'entity' => $entity,
                    'edit_form' => $form->createView(),
                );
    }
    
    /**
     * @Route("/create", name="_admin_publishing_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function createAction(Request $request) {
        
        $entity = new Publishing();
        
        $form = $this->publishingCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_publishing_edit', array('id' => $entity->getId())));
        }

        return array(
                    'entity' => $entity,
                    'edit_form' => $form->createView(),
                );
    }
    
    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
     * Creates a form to edit a Publishing entity.
     *
     * @param Publishing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function publishingEditForm(Publishing $entity) {
        $form = $this->createForm(new PublishingType(), $entity, array(
            'action' => $this->generateUrl('_admin_publishing_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_publishing_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:Publishing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publishing entity.');
        }

        $editForm = $this->publishingEditForm($entity);

        return array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView()
                );
    }

    /**
     * @Route("/update/{id}", name="_admin_publishing_update")
     * @Method("PUT")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaLibraryBundle:Publishing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find publishing entity.');
        }
        
        $form = $this->publishingEditForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            /* gets all the Persons inside the form we have related to the oeuvre */
            $relatedOeuvres = $entity->getOeuvres();
            
            /* Do a loop on it to persist the collection */
            foreach($relatedOeuvres as $o){
                $em->persist($o);
            }

            /* And flush every thing */
            $em->flush();

            return $this->redirect($this->generateUrl('_admin_publishing_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
        
        
    }

    /**************************************************
     * DELETE ENTITY
     **************************************************/
    
    /**
     * @Route("/delete/{id}", name="_admin_publishing_delete")
     * @Template("EncyclopediaAdminBundle:Publishing:new.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EncyclopediaLibraryBundle:Publishing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Publishing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('_admin_publishing'));
    }

    /**
     * Creates a form to delete a Publishing entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('_admin_publishing_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
