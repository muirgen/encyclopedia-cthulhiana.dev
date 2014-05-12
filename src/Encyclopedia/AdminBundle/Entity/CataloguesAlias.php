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
     * @var string
     * 
     * @ORM\Column(name="country", type="string", length=2, nullable=false)
     */
    protected $country;
    
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
     * @return CatalogueAlias
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
     * Set id_catalogue
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogue $idCatalogue
     * @return CatalogueAlias
     */
    public function setIdCatalogue(\Encyclopedia\AdminBundle\Entity\Catalogue $idCatalogue = null)
    {
        $this->id_catalogue = $idCatalogue;

        return $this;
    }

    /**
     * Get id_catalogue
     *
     * @return \Encyclopedia\AdminBundle\Entity\Catalogue 
     */
    public function getIdCatalogue()
    {
        return $this->id_catalogue;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return CatalogueAlias
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CatalogueAlias
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
     * @return CatalogueAlias
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
}
