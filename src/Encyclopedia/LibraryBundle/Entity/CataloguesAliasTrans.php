<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesAliasTrans
 * Entity to manage the translation item's name in the catalogues_alias table.
 *
 * @ORM\Table(name="catalogues_alias_trans")
 * @ORM\Entity
 */
class CataloguesAliasTrans {
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /** 
     * @ORM\ManyToOne(targetEntity="CataloguesAlias", inversedBy="translation")
     * @ORM\JoinColumn(name="id_alias", referencedColumnName="id")
     */
    protected $alias;
    
    /**
     * @var String
     * Iso code, take value from iso_code in table Lang. No FK, let the possibility 
     * to keep the code without the language reference and show the origin of the translation
     * 
     * @ORM\Column(name="iso_code", type="string", length=2, nullable=false)
     */
    protected $isocode;
    
    /**
     * @var String
     * 
     * @ORM\Column(name="name_trans", type="string", length=250, nullable=false)
     */
    protected $nameTrans;
    
    /**
     * @var String
     * 
     * @ORM\Column(name="idx_name_trans", type="string", length=250, nullable=false)
     */
    protected $idxNameTrans;
    

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
     * Set isocode
     *
     * @param string $isocode
     * @return CataloguesAliasTrans
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;

        return $this;
    }

    /**
     * Get isocode
     *
     * @return string 
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * Set nameTrans
     *
     * @param string $nameTrans
     * @return CataloguesAliasTrans
     */
    public function setNameTrans($nameTrans)
    {
        $this->nameTrans = $nameTrans;

        return $this;
    }

    /**
     * Get nameTrans
     *
     * @return string 
     */
    public function getNameTrans()
    {
        return $this->nameTrans;
    }
    
    /**
     * Set idxNameTrans
     *
     * @param string $idxNameTrans
     * @return CataloguesAliasTrans
     */
    public function setIdxNameTrans($idxNameTrans)
    {
        $this->idxNameTrans = $idxNameTrans;

        return $this;
    }

    /**
     * Get idxNameTrans
     *
     * @return string 
     */
    public function getIdxNameTrans()
    {
        return $this->idxNameTrans;
    }

    /**
     * Set alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias
     * @return CataloguesAliasTrans
     */
    public function setAlias(\Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias = null)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return \Encyclopedia\LibraryBundle\Entity\CataloguesAlias 
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
