<?php

namespace Encyclopedia\LibraryBundle\Entity;

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
     * @var string
     * 
     * @ORM\Column(name="idx_name", type="string", length=250, nullable=false)
     */
    protected $idxName;
    
    /**
     * @ORM\ManyToOne(targetEntity="Catalogues", inversedBy="alias")
     * @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     */
    private $catalogues;
    
    /**
     * @var text
     * 
     * @ORM\Column(name="note", type="text")
     */
    protected $note;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesAliasTrans", mappedBy="alias")
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
     * Set idxName
     *
     * @param string $idxName
     * @return CataloguesAlias
     */
    public function setIdxName($idxName)
    {
        $this->idxName = $idxName;

        return $this;
    }

    /**
     * Get idxName
     *
     * @return string 
     */
    public function getIdxName()
    {
        return $this->idxName;
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
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues
     * @return CataloguesAlias
     */
    public function setCatalogues(\Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues = null)
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
     * Add translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans $translation
     * @return CataloguesAlias
     */
    public function addTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans $translation)
    {
        $this->translation[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans $translation
     */
    public function removeTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans $translation)
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
