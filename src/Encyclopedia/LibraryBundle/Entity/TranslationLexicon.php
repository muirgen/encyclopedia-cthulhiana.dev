<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TranslationLexicon
 *
 * @ORM\Table(name="tt_lexicon", indexes={@ORM\Index(name="lexicon", columns={"fk_lexicon"}) })
 * @ORM\Entity
 */
class TranslationLexicon {
    
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
     * @ORM\ManyToOne(targetEntity="Lexicon", inversedBy="translation")
     * @ORM\JoinColumn(name="fk_lexicon", referencedColumnName="id")
     */
    protected $lexicon;

    /** 
     * @var string
     * 
     * @Assert\NotBlank(message="Iso Code cannot be empty")
     * @ORM\Column(name="str_iso_code", type="string", length=2, nullable=false)
     */
    protected $isoCode;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Translation string cannot be empty")
     * @ORM\Column(name="str_trans_term", type="string", length=250, nullable=false)
     */
    private $translation;

    

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
     * Set isoCode
     *
     * @param string $isoCode
     * @return TranslationLexicon
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set translation
     *
     * @param string $translation
     * @return TranslationLexicon
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string 
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set lexicon
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Lexicon $lexicon
     * @return TranslationLexicon
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
