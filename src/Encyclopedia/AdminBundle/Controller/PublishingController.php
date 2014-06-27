<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Encyclopedia\AdminBundle\Entity\Publishing;
use Encyclopedia\AdminBundle\Form\PublishingType;

/**
 * Description of OeuvresController
 *
 * @author Jenny
 *
 * @Route("/publishing")
 */
class PublishingController extends Controller {

    /**
     * @Route("/", name="_publishing")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EncyclopediaAdminBundle:Publishing')->findAll();

        return $this->render('EncyclopediaAdminBundle:Publishing:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * @Route("/create", name="_publishing_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:Publishing:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Publishing();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_publishing_show', array('id' => $entity->getId())));
        }

        return $this->render('EncyclopediaAdminBundle:Publishing:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Publishing entity.
     *
     * @param Publishing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Publishing $entity) {
        $form = $this->createForm(new PublishingType(), $entity, array(
            'action' => $this->generateUrl('_publishing_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * @Route("/new", name="_publishing_new")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function newAction() {
        $entity = new Publishing();
        $form = $this->createCreateForm($entity);

        return $this->render('EncyclopediaAdminBundle:Publishing:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/show/{id}", name="_publishing_show")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Publishing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publishing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EncyclopediaAdminBundle:Publishing:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="_publishing_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Publishing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Publishing entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EncyclopediaAdminBundle:Publishing:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Publishing entity.
     *
     * @param Publishing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Publishing $entity) {
        $form = $this->createForm(new PublishingType(), $entity, array(
            'action' => $this->generateUrl('_publishing_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * @Route("/update/{id}", name="_publishing_update")
     * @Method("PUT")
     * @Template("EncyclopediaAdminBundle:Publishing:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EncyclopediaAdminBundle:Publishing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find publishing entity.');
        }
        
        $form = $this->createEditForm($entity);
        
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

            return $this->redirect($this->generateUrl('_publishing_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $form->createView()
        );
        
        
    }

    /**
     * @Route("/delete/{id}", name="_publishing_delete")
     * @Template("EncyclopediaAdminBundle:Publishing:new.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EncyclopediaAdminBundle:Publishing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Publishing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('_publishing'));
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
                        ->setAction($this->generateUrl('_publishing_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
