<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogues
 *
 * @ORM\Table(name="catalogues", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="category", columns={"category"}), @ORM\Index(name="id_person", columns={"id_person"})})
 * @ORM\Entity
 */
class Catalogues
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
     * @var \Persons
     *
     * @ORM\ManyToOne(targetEntity="Persons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     * })
     */
    private $idPerson;

    /**
     * @var \CataloguesCategories
     *
     * @ORM\ManyToOne(targetEntity="CataloguesCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvres", mappedBy="idCatalogue")
     */
    private $idOeuvre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Catalogues", inversedBy="idCatalogue")
     * @ORM\JoinTable(name="catalogues_related",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_related", referencedColumnName="id")
     *   }
     * )
     */
    private $idRelated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idRelated = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Catalogues
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
     * Set idPerson
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Persons $idPerson
     * @return Catalogues
     */
    public function setIdPerson(\Encyclopedia\RessourcesBundle\Entity\Persons $idPerson = null)
    {
        $this->idPerson = $idPerson;

        return $this;
    }

    /**
     * Get idPerson
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\Persons 
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Set category
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $category
     * @return Catalogues
     */
    public function setCategory(\Encyclopedia\RessourcesBundle\Entity\CataloguesCategories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\CataloguesCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     * @return Catalogues
     */
    public function addIdOeuvre(\Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre)
    {
        $this->idOeuvre[] = $idOeuvre;

        return $this;
    }

    /**
     * Remove idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     */
    public function removeIdOeuvre(\Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre)
    {
        $this->idOeuvre->removeElement($idOeuvre);
    }

    /**
     * Get idOeuvre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdOeuvre()
    {
        return $this->idOeuvre;
    }

    /**
     * Add idRelated
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Catalogues $idRelated
     * @return Catalogues
     */
    public function addIdRelated(\Encyclopedia\RessourcesBundle\Entity\Catalogues $idRelated)
    {
        $this->idRelated[] = $idRelated;

        return $this;
    }

    /**
     * Remove idRelated
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Catalogues $idRelated
     */
    public function removeIdRelated(\Encyclopedia\RessourcesBundle\Entity\Catalogues $idRelated)
    {
        $this->idRelated->removeElement($idRelated);
    }

    /**
     * Get idRelated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdRelated()
    {
        return $this->idRelated;
    }
}
