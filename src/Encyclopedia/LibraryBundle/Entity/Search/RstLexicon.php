<?php
namespace Encyclopedia\LibraryBundle\Entity\Search;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RstLexicon
 *
 * 
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\LexiconRepository")
 */
class RstLexicon {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="category", type="string", length=250, nullable=false)
     */
    protected $category;
    
    /**
     * @var string
     * @ORM\Column(name="root_category", type="string", length=250, nullable=false)
     */
    protected $rootCategory;
    
    /**
     * @var string
     * @ORM\Column(name="str_term", type="string", length=250, nullable=false)
     */
    private $term;
    
    /**
     * @var string
     * @ORM\Column(name="idx_term", type="string", length=250, nullable=false)
     */
    private $idxTerm;
    

   
}
