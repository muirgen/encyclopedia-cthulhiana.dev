<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LexiconAlias
 *
 * @ORM\Table(name="tr_lexicon_alias", indexes={@ORM\Index(name="lexicon", columns={"fk_lexicon"})} )
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\LexiconRepository")
 */
class LexiconAlias {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \Lexicon
     * 
     * @ORM\OneToOne(targetEntity="Lexicon")
     * @ORM\JoinColumn(name="fk_lexicon", referencedColumnName="id")
     */
    protected $lexicon;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Alias cannot be empty")
     * @ORM\Column(name="str_term_alias", type="string", length=250, nullable=false)
     */
    private $termAlias;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Index alias cannot be empty")
     * @ORM\Column(name="idx_term_alias", type="string", length=250, nullable=false)
     */
    private $idxTermAlias;
    

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
     * Set termAlias
     *
     * @param string $termAlias
     * @return LexiconAlias
     */
    public function setTermAlias($termAlias)
    {
        $this->termAlias = $termAlias;

        return $this;
    }

    /**
     * Get termAlias
     *
     * @return string 
     */
    public function getTermAlias()
    {
        return $this->termAlias;
    }

    /**
     * Set idxTermAlias
     *
     * @param string $idxTermAlias
     * @return LexiconAlias
     */
    public function setIdxTermAlias($idxTermAlias)
    {
        $this->idxTermAlias = $idxTermAlias;

        return $this;
    }

    /**
     * Get idxTermAlias
     *
     * @return string 
     */
    public function getIdxTermAlias()
    {
        return $this->idxTermAlias;
    }

    /**
     * Set lexicon
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Lexicon $lexicon
     * @return LexiconAlias
     */
    public function setLexicon(\Encyclopedia\LibraryBundle\Entity\Lexicon $lexicon = null)
    {
        $this->lexicon = $lexicon;

        return $this;
    }

    /**
     * Get lexicon
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Lexicon 
     */
    public function getLexicon()
    {
        return $this->lexicon;
    }
}
