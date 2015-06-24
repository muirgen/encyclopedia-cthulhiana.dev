<?php
namespace Encyclopedia\AdminBundle\Controller\Lexicon;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

use Encyclopedia\LibraryBundle\Entity\Lexicon;
use Encyclopedia\LibraryBundle\Form\LexiconType;

/**
 * Description of TermController
 * All the terms from lexicon are stored in the tr_lexicon table.
 * @author Jenny
 * @Route("{_locale}/lexicon/term", defaults={"_locale" = "en"}, requirements={"_locale" = "[a-z]{2}"} )
 */
class TermController extends controller{

    /**
     * @Route("/index", name="_admin_lexicon_term_index")
     * @Template()
     */
    public function indexAction(){
       
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('Encyclopedia\LibraryBundle\Entity\Lexicon')->findBy(array(), null, 15);
        
        return array('list' => $list);
        
    }
    
    /**
     * @Route("/new", name="_admin_lexicon_term_new")
     * @Template("EncyclopediaAdminBundle:Lexicon/Term:edit.html.twig")
     */
    public function newAction(){
        
        $term = new Lexicon();
        $form = $this->lexiconTermCreateForm($term, 'Create');
        
        return array('nameOfAction' => 'Create',
            'form' => $form->createView());
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_lexicon_term_edit")
     * @Template()
     */
    public function editAction($id){
        
        $em = $this->getDoctrine()->getManager();
        
        $term = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')->find($id);

        $form = $this->lexiconTermCreateForm($term, 'Update');
        
        return array('nameOfAction' => 'Edit',
            'form' => $form->createView(),
            'term' => $term);
    }
    
    /**
     * @Route("/create", name="_admin_lexicon_term_create")
     * @Route("/update/{id}", name="_admin_lexicon_term_update")
     * @Template("EncyclopediaAdminBundle:Lexicon/Term:edit.html.twig")
     */
    public function updateAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $session = $request->getSession();
        
        if (!$id) {
            $lexiconTerm = new Lexicon();
            $btnForm = 'Create';
            $nameOfAction = 'New';
            $notice= 'Creation done.';
        } else {
            $lexiconTerm = $em->getRepository('EncyclopediaLibraryBundle:Lexicon')->findOneBy(array('id' => $id));
            $btnForm = 'Update';
            $nameOfAction = 'Edit';
            $notice = 'Update done.';
        }

        $form = $this->lexiconTermCreateForm($lexiconTerm, $btnForm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($lexiconTerm);
            $em->flush();
            
            $this->addFlash('notice', $notice);
        }

        return $this->redirect($this->generateUrl('_admin_lexicon_term_edit', array('id' => $lexiconTerm->getId())));
    }
    
    /**
     * Privates for internal functionnalities
     * Creation / Edition form function
     */
    private function lexiconTermCreateForm(Lexicon $entity, $labelBtn) {

        $urlAction = $this->generateUrl('_admin_lexicon_term_create');
        $refId = $entity->getId();
        if ($refId) {
            $urlAction = $this->generateUrl('_admin_lexicon_term_update', array('id' => $refId));
        }

        $form = $this->createForm(new LexiconType(), $entity, array(
            'action' => $urlAction,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $labelBtn));

        return $form;
    }
}
