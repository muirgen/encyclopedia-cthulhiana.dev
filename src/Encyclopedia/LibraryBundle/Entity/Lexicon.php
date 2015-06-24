<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lexicon
 *
 * @ORM\Table(name="tr_lexicon", indexes={@ORM\Index(name="fk_lexicon_category", columns={"fk_lexicon_category"})})
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\LexiconRepository")
 */
class Lexicon {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \LexiconCategory
     * 
     * @ORM\OneToOne(targetEntity="LexiconCategory")
     * @ORM\JoinColumn(name="fk_lexicon_category", referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Term cannot be empty")
     * @ORM\Column(name="str_term", type="string", length=250, nullable=false)
     */
    private $term;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Index term cannot be empty")
     * @ORM\Column(name="idx_term", type="string", length=250, nullable=false)
     */
    private $idxTerm;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set term
     *
     * @param string $term
     * @return Lexicon
     */
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return string 
     */
    public function getTerm()
    {
        return $this->term;
    }
    
    /**
     * Set term
     *
     * @param string $idxTerm
     * @return Lexicon
     */
    public function setIdxTerm($idxTerm)
    {
        $this->idxTerm = $idxTerm;

        return $this;
    }

    /**
     * Get idxTerm
     *
     * @return string 
     */
    public function getIdxTerm()
    {
        return $this->idxTerm;
    }

    /**
     * Set category
     *
     * @param \Encyclopedia\LibraryBundle\Entity\LexiconCategory $category
     * @return Lexicon
     */
    public function setCategory(\Encyclopedia\LibraryBundle\Entity\LexiconCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\LibraryBundle\Entity\LexiconCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
