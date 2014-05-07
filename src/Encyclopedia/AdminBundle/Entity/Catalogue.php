<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogue
 *
 * @ORM\Table(name="catalogue")
 * @ORM\Entity(repositoryClass="Encyclopedia\AdminBundle\Repository\CatalogueRepository")
 * 
 */
class Catalogue {

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
     * @var \Category
     * 
     * @ORM\OneToOne(targetEntity="CatalogueCategories")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @ORM\OneToOne(targetEntity="Persons")
     * @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     */
    protected $id_person;

    /**
     * @ORM\OneToMany(targetEntity="CatalogueAlias", mappedBy="id_catalogue")
     */
    protected $alias;
    
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
     * @return Catalogue
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
     * Set category
     *
     * @param \Encyclopedia\AdminBundle\Entity\CatalogueCategories $category
     * @return Catalogue
     */
    public function setCategory(\Encyclopedia\AdminBundle\Entity\CatalogueCategories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\AdminBundle\Entity\CatalogueCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set id_person
     *
     * @param \Encyclopedia\AdminBundle\Entity\Persons $idPerson
     * @return Catalogue
     */
    public function setIdPerson(\Encyclopedia\AdminBundle\Entity\Persons $idPerson = null)
    {
        $this->id_person = $idPerson;

        return $this;
    }

    /**
     * Get id_person
     *
     * @return \Encyclopedia\AdminBundle\Entity\Persons 
     */
    public function getIdPerson()
    {
        return $this->id_person;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add alias
     *
     * @param \Encyclopedia\AdminBundle\Entity\CatalogueAlias $alias
     * @return Catalogue
     */
    public function addAlias(\Encyclopedia\AdminBundle\Entity\CatalogueAlias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \Encyclopedia\AdminBundle\Entity\CatalogueAlias $alias
     */
    public function removeAlias(\Encyclopedia\AdminBundle\Entity\CatalogueAlias $alias)
    {
        $this->alias->removeElement($alias);
    }

    /**
     * Get alias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
