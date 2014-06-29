<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesOeuvres
 *
 * @ORM\Table(name="catalogues_oeuvres")
 * @ORM\Entity
 */
class CataloguesOeuvres {
    

    /** 
     * @ORM\ManyToOne(targetEntity="Catalogues", inversedBy="cataloguesOeuvres")
     * @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     * @ORM\Id
     */
    private $catalogues;
    
    /** 
     * @ORM\ManyToOne(targetEntity="Oeuvres", inversedBy="cataloguesOeuvres")
     * @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     * @ORM\Id
     */
    private $oeuvres;
    
    /**
     * @var Boolean
     * 
     * @ORM\Column(name="first_appearance", type="boolean", nullable=false)
     */
    private $firstAppearance;
   
    /**
     * Set firstAppearance
     *
     * @param boolean $firstAppearance
     * @return CataloguesOeuvres
     */
    public function setFirstAppearance($firstAppearance)
    {
        $this->firstAppearance = $firstAppearance;

        return $this;
    }

    /**
     * Get firstAppearance
     *
     * @return boolean 
     */
    public function getFirstAppearance()
    {
        return $this->firstAppearance;
    }

    /**
     * Set catalogues
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues
     * @return CataloguesOeuvres
     */
    public function setCatalogues(\Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues)
    {
        $this->catalogues = $catalogues;

        return $this;
    }

    /**
     * Get catalogues
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Catalogues 
     */
    public function getCatalogues()
    {
        return $this->catalogues;
    }

    /**
     * Set oeuvres
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres
     * @return CataloguesOeuvres
     */
    public function setOeuvres(\Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres = $oeuvres;

        return $this;
    }

    /**
     * Get oeuvres
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Oeuvres 
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }
}
