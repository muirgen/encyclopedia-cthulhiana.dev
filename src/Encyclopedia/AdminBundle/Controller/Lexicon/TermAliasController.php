<?php
namespace Encyclopedia\AdminBundle\Controller\Lexicon;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

use Encyclopedia\LibraryBundle\Entity\LexiconAlias;
use Encyclopedia\LibraryBundle\Form\LexiconAliasType;

/**
 * Description of TermAliasController
 * All the alias of terms from lexicon are stored in the tr_lexicon_alias table.
 * @author Jenny
 * @Route("{_locale}/lexicon/term/{idLexiconTerm}/alias", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class TermAliasController extends controller{
    
    /**
     * @Route("/new/", name="_admin_lexicon_alias_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/TermAlias:edit.html.twig")
     */
    public function newAction($idLexiconTerm){
        
        $em = $this->getDoctrine()->getManager();
        $term = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')->find($idLexiconTerm);
        
        $alias = new LexiconAlias();
        $form = $this->lexiconAliasCreateForm($alias, 'Create', $idLexiconTerm);
        
        return array('nameOfAction' => 'Create',
            'term' => $term,
            'form' => $form->createView());
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_lexicon_alias_edit")
     * @Template()
     */
    public function editAction($id,$idLexiconTerm){
        
        $em = $this->getDoctrine()->getManager();
        $term = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')->find($idLexiconTerm);
        $alias = $em->getRepository('EncyclopediaLibraryBundle:LexiconAlias')->find($id);

        $form = $this->lexiconAliasCreateForm($alias, 'Update',$idLexiconTerm);
        
        return array('nameOfAction' => 'Edit',
            'term' => $term,
            'form' => $form->createView(),
            'alias' => $alias);
    }
    
    /**
     * @Route("/create", name="_admin_lexicon_alias_create")
     * @Route("/update/{id}", name="_admin_lexicon_alias_update")
     */
    public function updateAction(Request $request, $idLexiconTerm) {
        
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $session = $request->getSession();
        
        if (!$id) {
            $lexiconAlias = new LexiconAlias();
            $btnForm = 'Create';
            $nameOfAction = 'New';
            $notice= 'Creation done.';
        } else {
            $lexiconAlias = $em->getRepository('EncyclopediaLibraryBundle:LexiconAlias')->findOneBy(array('id' => $id));
            $btnForm = 'Update';
            $nameOfAction = 'Edit';
            $notice = 'Update done.';
        }

        $form = $this->lexiconAliasCreateForm($lexiconAlias, $btnForm, $idLexiconTerm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($lexiconAlias);
            $em->flush();
            
            $this->addFlash('notice', $notice);
        }

        return $this->redirect($this->generateUrl('_admin_lexicon_alias_edit', array('idLexiconTerm' => $idLexiconTerm, 'id' => $lexiconAlias->getId())));
    }
    
    /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function lexiconAliasCreateForm(LexiconAlias $entity, $labelBtn, $idLexiconTerm) {

        $urlAction = $this->generateUrl('_admin_lexicon_alias_create', array('idLexiconTerm' => $idLexiconTerm));
        $refId = $entity->getId();
        if ($refId) {
            $urlAction = $this->generateUrl('_admin_lexicon_alias_update', array('idLexiconTerm' => $idLexiconTerm, 'id' => $refId));
        }

        $term = $this->getDoctrine()->getManager()->getRepository('EncyclopediaLibraryBundle:Lexicon')->find($idLexiconTerm);
        $entity->setLexicon($term);
        
        $form = $this->createForm(new LexiconAliasType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $labelBtn));

        return $form;
    }
    
}
