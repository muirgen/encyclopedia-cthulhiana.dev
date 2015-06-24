<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TranslationLexiconCategory
 *
 * @ORM\Table(name="tt_lexicon_category", indexes={@ORM\Index(name="language", columns={"fk_language"}), @ORM\Index(name="category", columns={"fk_lexicon_category"} ) })
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\TranslationLexiconCategoryRepository")
 */
class TranslationLexiconCategory {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /** 
     * @var \Category
     * 
     * @ORM\ManyToOne(targetEntity="LexiconCategory", inversedBy="translation")
     * @ORM\JoinColumn(name="fk_lexicon_category", referencedColumnName="id")
     */
    protected $category;

    /** 
     * @var \Language
     * 
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="fk_language", referencedColumnName="id")
     */
    protected $language;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Translation string must not be empty")
     * @ORM\Column(name="str_trans_category", type="string", length=250, nullable=false)
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
     * Set strTransCategory
     *
     * @param string $strTransCategory
     * @return TranslationLexiconCategory
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get strTransCategory
     *
     * @return string 
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set category
     *
     * @param \Encyclopedia\LibraryBundle\Entity\LexiconCategory $category
     * @return TranslationLexiconCategory
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

    /**
     * Set language
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Language $language
     * @return TranslationLexiconCategory
     */
    public function setLanguage(\Encyclopedia\LibraryBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
