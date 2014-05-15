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
    private $id_catalogue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="cataloguesAliasLang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     */
    protected $id_lang;
    
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
     * Set id_catalogue
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $idCatalogue
     * @return CataloguesAlias
     */
    public function setIdCatalogue(\Encyclopedia\AdminBundle\Entity\Catalogues $idCatalogue = null)
    {
        $this->id_catalogue = $idCatalogue;

        return $this;
    }

    /**
     * Get id_catalogue
     *
     * @return \Encyclopedia\AdminBundle\Entity\Catalogues 
     */
    public function getIdCatalogue()
    {
        return $this->id_catalogue;
    }

    /**
     * Set id_lang
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $idLang
     * @return CataloguesAlias
     */
    public function setIdLang(\Encyclopedia\AdminBundle\Entity\Lang $idLang = null)
    {
        $this->id_lang = $idLang;

        return $this;
    }

    /**
     * Get id_lang
     *
     * @return \Encyclopedia\AdminBundle\Entity\Lang 
     */
    public function getIdLang()
    {
        return $this->id_lang;
    }
}
