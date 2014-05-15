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
    protected $lang;
    
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
     * Set lang
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $lang
     * @return CataloguesCategoriesTrans
     */
    public function setLang(\Encyclopedia\AdminBundle\Entity\Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \Encyclopedia\AdminBundle\Entity\Lang 
     */
    public function getLang()
    {
        return $this->lang;
    }
}
