<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesCategoriesTrans
 *
 * @ORM\Table(name="catalogues_categories_trans")
 * @ORM\Entity
 * 
 */
class CataloguesCategoriesTrans {
    
    /** 
     * @ORM\ManyToOne(targetEntity="CataloguesCategories", inversedBy="translation")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     * @ORM\Id
     */
    protected $category;

    /** 
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="cataloguesCategoriesLang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     * @ORM\Id
     */
    protected $languages;
    
    /**
     * @var string
     * @ORM\Column(name="name_trans", type="string", length=250, nullable=false)
     */
    protected $name_trans;
    
    /**
     * Set name_trans
     *
     * @param string $nameTrans
     * @return CataloguesCategoriesTrans
     */
    public function setNameTrans($nameTrans)
    {
        $this->name_trans = $nameTrans;

        return $this;
    }

    /**
     * Get name_trans
     *
     * @return string 
     */
    public function getNameTrans()
    {
        return $this->name_trans;
    }

    /**
     * Set category
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesCategories $category
     * @return CataloguesCategoriesTrans
     */
    public function setCategory(\Encyclopedia\AdminBundle\Entity\CataloguesCategories $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\AdminBundle\Entity\CataloguesCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set languages
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $languages
     * @return CataloguesCategoriesTrans
     */
    public function setLanguages(\Encyclopedia\AdminBundle\Entity\Lang $languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \Encyclopedia\AdminBundle\Entity\Lang 
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}