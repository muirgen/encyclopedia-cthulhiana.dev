<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogues
 *
 * @ORM\Table(name="catalogues")
 * @ORM\Entity(repositoryClass="Encyclopedia\AdminBundle\Repository\CataloguesRepository")
 */
class Catalogues {

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
     * @var \Category
     * 
     * @ORM\OneToOne(targetEntity="CataloguesCategories")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @var string
     * 
     * @ORM\OneToOne(targetEntity="Persons")
     * @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     */
    protected $idPerson;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesAlias", mappedBy="catalogues")
     */
    protected $alias;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesOeuvres", mappedBy="catalogues")
     */
    protected $cataloguesOeuvres;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Catalogues", mappedBy="relatedItems")
     */
    
    protected $cataloguesItems;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Catalogues", inversedBy="cataloguesItems")
     * @ORM\JoinTable(name="catalogues_related",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_related", referencedColumnName="id")
     *   }
     * )
     */
    protected $relatedItems;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesOeuvres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relatedItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set category
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesCategories $category
     * @return Catalogues
     */
    public function setCategory(\Encyclopedia\AdminBundle\Entity\CataloguesCategories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\AdminBundle\Entity\CataloguesCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set idPerson
     *
     * @param \Encyclopedia\AdminBundle\Entity\Persons $idPerson
     * @return Catalogues
     */
    public function setIdPerson(\Encyclopedia\AdminBundle\Entity\Persons $idPerson = null)
    {
        $this->idPerson = $idPerson;

        return $this;
    }

    /**
     * Get idPerson
     *
     * @return \Encyclopedia\AdminBundle\Entity\Persons 
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Add alias
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesAlias $alias
     * @return Catalogues
     */
    public function addAlias(\Encyclopedia\AdminBundle\Entity\CataloguesAlias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesAlias $alias
     */
    public function removeAlias(\Encyclopedia\AdminBundle\Entity\CataloguesAlias $alias)
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

    /**
     * Add cataloguesOeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesOeuvres $cataloguesOeuvres
     * @return Catalogues
     */
    public function addCataloguesOeuvre(\Encyclopedia\AdminBundle\Entity\CataloguesOeuvres $cataloguesOeuvres)
    {
        $this->cataloguesOeuvres[] = $cataloguesOeuvres;

        return $this;
    }

    /**
     * Remove cataloguesOeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\CataloguesOeuvres $cataloguesOeuvres
     */
    public function removeCataloguesOeuvre(\Encyclopedia\AdminBundle\Entity\CataloguesOeuvres $cataloguesOeuvres)
    {
        $this->cataloguesOeuvres->removeElement($cataloguesOeuvres);
    }

    /**
     * Get cataloguesOeuvres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCataloguesOeuvres()
    {
        return $this->cataloguesOeuvres;
    }

    /**
     * Add cataloguesItems
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $cataloguesItems
     * @return Catalogues
     */
    public function addCataloguesItem(\Encyclopedia\AdminBundle\Entity\Catalogues $cataloguesItems)
    {
        $this->cataloguesItems[] = $cataloguesItems;

        return $this;
    }

    /**
     * Remove cataloguesItems
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $cataloguesItems
     */
    public function removeCataloguesItem(\Encyclopedia\AdminBundle\Entity\Catalogues $cataloguesItems)
    {
        $this->cataloguesItems->removeElement($cataloguesItems);
    }

    /**
     * Get cataloguesItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCataloguesItems()
    {
        return $this->cataloguesItems;
    }

    /**
     * Add relatedItems
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $relatedItems
     * @return Catalogues
     */
    public function addRelatedItems(\Encyclopedia\AdminBundle\Entity\Catalogues $relatedItems)
    {
        $this->relatedItems[] = $relatedItems;

        return $this;
    }

    /**
     * Remove relatedItems
     *
     * @param \Encyclopedia\AdminBundle\Entity\Catalogues $relatedItems
     */
    public function removeRelatedItems(\Encyclopedia\AdminBundle\Entity\Catalogues $relatedItems)
    {
        $this->relatedItems->removeElement($relatedItems);
        
    }

    /**
     * Get relatedItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelatedItems()
    {
        return $this->relatedItems;
    }
}
