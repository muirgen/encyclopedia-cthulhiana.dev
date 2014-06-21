<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesCategories
 *
 * @ORM\Table(name="catalogues_categories", indexes={@ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class CataloguesCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Lang", inversedBy="idCategory")
     * @ORM\JoinTable(name="catalogues_categories_trans",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     *   }
     * )
     */
    private $idLang;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idLang = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CataloguesCategories
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
     * Add idLang
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Lang $idLang
     * @return CataloguesCategories
     */
    public function addIdLang(\Encyclopedia\RessourcesBundle\Entity\Lang $idLang)
    {
        $this->idLang[] = $idLang;

        return $this;
    }

    /**
     * Remove idLang
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Lang $idLang
     */
    public function removeIdLang(\Encyclopedia\RessourcesBundle\Entity\Lang $idLang)
    {
        $this->idLang->removeElement($idLang);
    }

    /**
     * Get idLang
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdLang()
    {
        return $this->idLang;
    }
}
