<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogueAlias
 *
 * @ORM\Table(name="catalogue_alias")
 * @ORM\Entity
 * 
 */
class CatalogueAlias {
   
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Catalogue", inversedBy="alias")
     * @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     */
    private $id_catalogue;
    

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
}
