<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Encyclopedia\AdminBundle\Form\OeuvresAliasType;
use Encyclopedia\AdminBundle\Entity\OeuvresAlias;

/**
 * Description of CataloguesAliasController
 *
 * @author Jenny
 *
 * @Route("/oeuvres/alias")
 */
class OeuvresAliasController extends Controller {
    
    /**************************************************
     * CREATE ENTITY
     ************************************************* */

    /**
     * Creates a form to create a OeuvresAlias entity.
     * @param OeuvresAlias $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function oeuvresAliasCreateForm(OeuvresAlias $entity, $id_oeuvre) {

        $form = $this->createForm(new OeuvresAliasType(), $entity, array(
            'action' => $this->generateUrl('_oeuvres_alias_create',array('id_oeuvre' => $id_oeuvre)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/id-oeuvre-{id_oeuvre}/new", name="_oeuvres_alias_new")
     * @Template("EncyclopediaAdminBundle:OeuvresAlias:edit.html.twig")
     */
    public function newAction($id_oeuvre) {
        
        $em = $this->getDoctrine()->getManager();
        $oeuvre = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id_oeuvre);
        
        $entity = new OeuvresAlias();
        $entity->setOeuvres($oeuvre);
     
        $form = $this->oeuvresAliasCreateForm($entity,$id_oeuvre);
        
        return array(
            'entity'      => $entity,
            'oeuvre'   => $oeuvre,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/id-oeuvre-{id_oeuvre}/create", name="_oeuvres_alias_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:OeuvresAlias:edit.html.twig")
     */
    public function createAction(Request $request, $id_oeuvre) {
        
        $em = $this->getDoctrine()->getManager();
        $oeuvre = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id_oeuvre);
        
        $entity = new OeuvresAlias();
        
        $form = $this->oeuvresAliasCreateForm($entity, $id_oeuvre);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_oeuvres_alias_edit', array('id_oeuvre' => $id_oeuvre, 'id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'oeuvre' => $oeuvre,
            'edit_form'   => $form->createView(),
        );
    }

    /**************************************************
     * EDIT ENTITY
     **************************************************/
    
    /**
    * Creates a form to edit a OeuvresAlias entity.
    * @param Oeuvres $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function oeuvresAliasEditForm(OeuvresAlias $entity, $id_oeuvre)
    {
        $form = $this->createForm(new OeuvresAliasType(), $entity, array(
            'action' => $this->generateUrl('_oeuvres_alias_update', array('id' => $entity->getId(),'id_oeuvre' => $id_oeuvre)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/id-oeuvre-{id_oeuvre}/edit/{id}/", name="_oeuvres_alias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id, $id_oeuvre) {
        
        $em = $this->getDoctrine()->getManager();
        $oeuvre = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id_oeuvre);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:OeuvresAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oeuvres Alias entity.');
        }
        
        $form = $this->oeuvresAliasEditForm($entity, $id_oeuvre);
        
        return array(
            'entity'      => $entity,
            'oeuvre'   => $oeuvre,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/id-oeuvre-{id_oeuvre}/update/{id}", name="_oeuvres_alias_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:OeuvresAlias:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $id_oeuvre){
        
        $em = $this->getDoctrine()->getManager();
        $oeuvre = $em->getRepository('EncyclopediaAdminBundle:Oeuvres')->find($id_oeuvre);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:OeuvresAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oeuvres Alias entity.');
        }
        
        $form = $this->oeuvresAliasEditForm($entity, $id_oeuvre);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_oeuvres_alias_edit', array('id' => $id, 'id_oeuvre' => $id_oeuvre)));
        }

        return array(
            'entity'      => $entity,
            'oeuvre'   => $oeuvre,
            'edit_form'   => $form->createView()
        );
    }
    
}
