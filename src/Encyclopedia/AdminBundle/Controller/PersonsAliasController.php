<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Encyclopedia\AdminBundle\Form\PersonsAliasType;
use Encyclopedia\AdminBundle\Entity\PersonsAlias;

/**
 * Description of PersonsAliasController
 *
 * @author Jenny
 *
 * @Route("/persons/alias")
 */
class PersonsAliasController extends Controller {
    
    /**************************************************
     * CREATE ENTITY
     ************************************************* */

    /**
     * Creates a form to create a PersonAlias entity.
     * @param PersonsAlias $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function personsAliasCreateForm(PersonsAlias $entity, $id_person) {

        $form = $this->createForm(new PersonsAliasType(), $entity, array(
            'action' => $this->generateUrl('_persons_alias_create',array('id_person' => $id_person)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/id-person-{id_person}/new", name="_persons_alias_new")
     * @Template("EncyclopediaAdminBundle:personsAlias:edit.html.twig")
     */
    public function newAction($id_person) {
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id_person);
        
        $entity = new PersonsAlias();
        $entity->setIdPerson($person);
     
        $form = $this->personsAliasCreateForm($entity,$id_person);
        
        return array(
            'entity'      => $entity,
            'person'   => $person,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/id-person-{id_person}/create", name="_persons_alias_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:personsAlias:edit.html.twig")
     */
    public function createAction(Request $request, $id_person) {
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id_person);
        
        $entity = new PersonsAlias();
        
        $form = $this->personsAliasCreateForm($entity, $id_person);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_persons_alias_edit', array('id_person' => $id_person, 'id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'person' => $person,
            'edit_form'   => $form->createView(),
        );
    }

    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
    * Creates a form to edit a Person entity.
    * @param Person $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function personsAliasEditForm(PersonsAlias $entity, $id_person)
    {
        $form = $this->createForm(new PersonsAliasType(), $entity, array(
            'action' => $this->generateUrl('_persons_alias_update', array('id' => $entity->getId(),'id_person' => $id_person)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/id-person-{id_person}/edit/{id}/", name="_persons_alias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id, $id_person) {
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id_person);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:PersonsAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }
        
        $form = $this->personsAliasEditForm($entity, $id_person);
        
        return array(
            'entity'      => $entity,
            'person'   => $person,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/id-person-{id_person}/update/{id}", name="_persons_alias_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:PersonsAlias:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $id_person){
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('EncyclopediaAdminBundle:Persons')->find($id_person);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:PersonsAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }
        
        $form = $this->personsAliasEditForm($entity, $id_person);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_persons_alias_edit', array('id' => $id, 'id_person' => $id_person)));
        }

        return array(
            'entity'      => $entity,
            'person'   => $person,
            'edit_form'   => $form->createView()
        );
    }
    
}
