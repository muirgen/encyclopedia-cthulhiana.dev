<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LexiconCategory
 *
 * @ORM\Table(name="tr_lexicon_category")
 * @ORM\Entity
 */
class LexiconCategory {
    
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
     * @Assert\NotBlank(message="Category name must not be empty")
     * @ORM\Column(name="str_category", type="string", length=250, nullable=false)
     */
    private $category;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="TranslationLexiconCategory", mappedBy="category")
     */
    protected $translation;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translation = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set category
     *
     * @param string $category
     * @return LexiconCategory
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory $translation
     * @return LexiconCategory
     */
    public function addTranslation(\Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory $translation)
    {
        $this->translation[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory $translation
     */
    public function removeTranslation(\Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory $translation)
    {
        $this->translation->removeElement($translation);
    }

    /**
     * Get translation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslation()
    {
        return $this->translation;
    }
}
