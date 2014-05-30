<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesAlias
 *
 * @ORM\Table(name="catalogues_alias")
 * @ORM\Entity
 * 
 */
class CataloguesAlias {
   
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
     * @ORM\ManyToOne(targetEntity="Catalogues", inversedBy="alias")
     * @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     */
    private $catalogues;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="cataloguesAliasLang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     */
    protected $languages;
    
    /**
     * @var text
     * 
     * @ORM\Column(name="description", type="text")
     */
    protected $description;
    
    /**
     * @var text
     * 
     * @ORM\Column(name="note", type="text")
     */
    protected $note;
    

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
     * @return CataloguesAlias
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
     * Set description
     *
     * @param string $description
     * @return CataloguesAlias
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return CataloguesAlias
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set catalogues
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $catalogues
     * @return CataloguesAlias
     */
    public function setCatalogues(\Encyclopedia\AdminBundle\Entity\Catalogues $catalogues = null)
    {
        $this->catalogues = $catalogues;

        return $this;
    }

    /**
     * Get catalogues
     *
     * @return \Encyclopedia\AdminBundle\Entity\Catalogues 
     */
    public function getCatalogues()
    {
        return $this->catalogues;
    }

    /**
     * Set languages
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $languages
     * @return CataloguesAlias
     */
    public function setLanguages(\Encyclopedia\AdminBundle\Entity\Lang $languages = null)
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
