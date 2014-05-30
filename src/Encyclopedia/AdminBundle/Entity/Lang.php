<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lang
 *
 * @ORM\Table(name="lang")
 * @ORM\Entity
 * 
 */
class Lang {
   
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
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    protected $name;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="iso_code", type="string", length=2, nullable=false)
     */
    protected $isoCode;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="language_code", type="string", length=5, nullable=false)
     */
    protected $languageCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesAlias", mappedBy="languages")
     */
    protected $cataloguesAliasLang;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesCategoriesTrans", mappedBy="languages")
     */
    protected $cataloguesCategoriesLang;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="OeuvresAlias", mappedBy="languages")
     */
    protected $oeuvresAliasLang;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cataloguesAliasLang = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesCategoriesLang = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oeuvresAliasLang = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add cataloguesAliasLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesAlias $cataloguesAliasLang
     * @return Lang
     */
    public function addCataloguesAliasLang(\Encyclopedia\AdminBundle\Entity\CataloguesAlias $cataloguesAliasLang)
    {
        $this->cataloguesAliasLang[] = $cataloguesAliasLang;

        return $this;
    }

    /**
     * Remove cataloguesAliasLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesAlias $cataloguesAliasLang
     */
    public function removeCataloguesAliasLang(\Encyclopedia\AdminBundle\Entity\CataloguesAlias $cataloguesAliasLang)
    {
        $this->cataloguesAliasLang->removeElement($cataloguesAliasLang);
    }

    /**
     * Get cataloguesAliasLang
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCataloguesAliasLang()
    {
        return $this->cataloguesAliasLang;
    }

    /**
     * Add cataloguesCategoriesLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesCategoriesTrans $cataloguesCategoriesLang
     * @return Lang
     */
    public function addCataloguesCategoriesLang(\Encyclopedia\AdminBundle\Entity\CataloguesCategoriesTrans $cataloguesCategoriesLang)
    {
        $this->cataloguesCategoriesLang[] = $cataloguesCategoriesLang;

        return $this;
    }

    /**
     * Remove cataloguesCategoriesLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesCategoriesTrans $cataloguesCategoriesLang
     */
    public function removeCataloguesCategoriesLang(\Encyclopedia\AdminBundle\Entity\CataloguesCategoriesTrans $cataloguesCategoriesLang)
    {
        $this->cataloguesCategoriesLang->removeElement($cataloguesCategoriesLang);
    }

    /**
     * Get cataloguesCategoriesLang
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCataloguesCategoriesLang()
    {
        return $this->cataloguesCategoriesLang;
    }

    /**
     * Add oeuvresAliasLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\OeuvresAlias $oeuvresAliasLang
     * @return Lang
     */
    public function addOeuvresAliasLang(\Encyclopedia\AdminBundle\Entity\OeuvresAlias $oeuvresAliasLang)
    {
        $this->oeuvresAliasLang[] = $oeuvresAliasLang;

        return $this;
    }

    /**
     * Remove oeuvresAliasLang
     *
     * @param \Encyclopedia\AdminBundle\Entity\OeuvresAlias $oeuvresAliasLang
     */
    public function removeOeuvresAliasLang(\Encyclopedia\AdminBundle\Entity\OeuvresAlias $oeuvresAliasLang)
    {
        $this->oeuvresAliasLang->removeElement($oeuvresAliasLang);
    }

    /**
     * Get oeuvresAliasLang
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOeuvresAliasLang()
    {
        return $this->oeuvresAliasLang;
    }
}
