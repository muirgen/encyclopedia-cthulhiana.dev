<?php

namespace Encyclopedia\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Encyclopedia\AdminBundle\Form\CataloguesAliasType;
use Encyclopedia\AdminBundle\Entity\CataloguesAlias;

/**
 * Description of CataloguesAliasController
 *
 * @author Jenny
 *
 * @Route("/catalogues/alias")
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
            'action' => $this->generateUrl('_catalogues_alias_create',array('id_catalogue' => $id_catalogue)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        return $form;
    }
    
    /**
     * @Route("/id-catalogue-{id_catalogue}/new", name="_catalogues_alias_new")
     * @Template("EncyclopediaAdminBundle:cataloguesAlias:edit.html.twig")
     */
    public function newAction($id_catalogue) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id_catalogue);
        
        $entity = new CataloguesAlias();
        $entity->setIdCatalogue($catalogue);
     
        $form = $this->cataloguesAliasCreateForm($entity,$id_catalogue);
        
        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView()
        );
    }
    
    /**
     * @Route("/id-catalogue-{id_catalogue}/create", name="_catalogues_alias_create")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:cataloguesAlias:edit.html.twig")
     */
    public function createAction(Request $request, $id_catalogue) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id_catalogue);
        
        $entity = new CataloguesAlias();
        
        $form = $this->cataloguesAliasCreateForm($entity, $id_catalogue);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogues_alias_edit', array('id_catalogue' => $id_catalogue, 'id' => $entity->getId())));
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
    * Creates a form to edit a Catalogue entity.
    * @param Catalogue $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function cataloguesAliasEditForm(CataloguesAlias $entity, $id_catalogue)
    {
        $form = $this->createForm(new CataloguesAliasType(), $entity, array(
            'action' => $this->generateUrl('_catalogues_alias_update', array('id' => $entity->getId(),'id_catalogue' => $id_catalogue)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * @Route("/id-catalogue-{id_catalogue}/edit/{id}/", name="_catalogues_alias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id, $id_catalogue) {
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id_catalogue);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:CataloguesAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
        }
        
        $form = $this->cataloguesAliasEditForm($entity, $id_catalogue);
        
        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView()
        );
    }

    /**
     * @Route("/id-catalogue-{id_catalogue}/update/{id}", name="_catalogues_alias_update")
     * @Method("POST")
     * @Template("EncyclopediaAdminBundle:CataloguesAlias:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $id_catalogue){
        
        $em = $this->getDoctrine()->getManager();
        $catalogue = $em->getRepository('EncyclopediaAdminBundle:Catalogues')->find($id_catalogue);
        
        $entity = $em->getRepository('EncyclopediaAdminBundle:CataloguesAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogue entity.');
        }
        
        $form = $this->cataloguesAliasEditForm($entity, $id_catalogue);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_catalogues_alias_edit', array('id' => $id, 'id_catalogue' => $id_catalogue)));
        }

        return array(
            'entity'      => $entity,
            'catalogue'   => $catalogue,
            'edit_form'   => $form->createView()
        );
    }
    
}
