<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesCategories
 *
 * @ORM\Table(name="catalogues_categories")
 * @ORM\Entity
 * 
 */
class CataloguesCategories {
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    protected $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesCategoriesTrans", mappedBy="category")
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
     * Set name
     *
     * @param string $name
     * @return CataloguesCategories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesCategoriesTrans $translation
     * @return CataloguesCategories
     */
    public function addTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesCategoriesTrans $translation)
    {
        $this->translation[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesCategoriesTrans $translation
     */
    public function removeTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesCategoriesTrans $translation)
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
