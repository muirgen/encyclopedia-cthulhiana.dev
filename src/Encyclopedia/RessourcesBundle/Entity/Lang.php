<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lang
 *
 * @ORM\Table(name="lang", indexes={@ORM\Index(name="iso_code", columns={"iso_code"})})
 * @ORM\Entity
 */
class Lang
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code", type="string", length=2, nullable=false)
     */
    private $isoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="language_code", type="string", length=5, nullable=false)
     */
    private $languageCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CataloguesCategories", mappedBy="idLang")
     */
    private $idCategory;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCategory = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Lang
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
     * Set isoCode
     *
     * @param string $isoCode
     * @return Lang
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
     * Set languageCode
     *
     * @param string $languageCode
     * @return Lang
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * Get languageCode
     *
     * @return string 
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * Add idCategory
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $idCategory
     * @return Lang
     */
    public function addIdCategory(\Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $idCategory)
    {
        $this->idCategory[] = $idCategory;

        return $this;
    }

    /**
     * Remove idCategory
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $idCategory
     */
    public function removeIdCategory(\Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $idCategory)
    {
        $this->idCategory->removeElement($idCategory);
    }

    /**
     * Get idCategory
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }
}
