<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogues
 *
 * @ORM\Table(name="catalogues")
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\CataloguesRepository")
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
     * @var string
     * 
     * @ORM\Column(name="idx_name", type="string", length=250, nullable=false)
     */
    protected $idxName;
    
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
    protected $person;

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
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesTrans", mappedBy="catalogues")
     */
    protected $translation;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesArticles", mappedBy="catalogues")
     */
    protected $articles;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesOeuvres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relatedItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idxName
     *
     * @param string $idxName
     * @return Catalogues
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
     * Set category
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesCategories $category
     * @return Catalogues
     */
    public function setCategory(\Encyclopedia\LibraryBundle\Entity\CataloguesCategories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Encyclopedia\LibraryBundle\Entity\CataloguesCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set person
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Persons $person
     * @return Catalogues
     */
    public function setPerson(\Encyclopedia\LibraryBundle\Entity\Persons $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Persons 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias
     * @return Catalogues
     */
    public function addAlias(\Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias
     */
    public function removeAlias(\Encyclopedia\LibraryBundle\Entity\CataloguesAlias $alias)
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
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesOeuvres $cataloguesOeuvres
     * @return Catalogues
     */
    public function addCataloguesOeuvre(\Encyclopedia\LibraryBundle\Entity\CataloguesOeuvres $cataloguesOeuvres)
    {
        $this->cataloguesOeuvres[] = $cataloguesOeuvres;

        return $this;
    }

    /**
     * Remove cataloguesOeuvres
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesOeuvres $cataloguesOeuvres
     */
    public function removeCataloguesOeuvre(\Encyclopedia\LibraryBundle\Entity\CataloguesOeuvres $cataloguesOeuvres)
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
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $cataloguesItems
     * @return Catalogues
     */
    public function addCataloguesItem(\Encyclopedia\LibraryBundle\Entity\Catalogues $cataloguesItems)
    {
        $this->cataloguesItems[] = $cataloguesItems;

        return $this;
    }

    /**
     * Remove cataloguesItems
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $cataloguesItems
     */
    public function removeCataloguesItem(\Encyclopedia\LibraryBundle\Entity\Catalogues $cataloguesItems)
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
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $relatedItems
     * @return Catalogues
     */
    public function addRelatedItem(\Encyclopedia\LibraryBundle\Entity\Catalogues $relatedItems)
    {
        $this->relatedItems[] = $relatedItems;

        return $this;
    }

    /**
     * Remove relatedItems
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $relatedItems
     */
    public function removeRelatedItem(\Encyclopedia\LibraryBundle\Entity\Catalogues $relatedItems)
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

    /**
     * Add translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesTrans $translation
     * @return Catalogues
     */
    public function addTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesTrans $translation)
    {
        $this->translation[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesTrans $translation
     */
    public function removeTranslation(\Encyclopedia\LibraryBundle\Entity\CataloguesTrans $translation)
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

    /**
     * Add articles
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesArticles $articles
     * @return Catalogues
     */
    public function addArticle(\Encyclopedia\LibraryBundle\Entity\CataloguesArticles $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Encyclopedia\LibraryBundle\Entity\CataloguesArticles $articles
     */
    public function removeArticle(\Encyclopedia\LibraryBundle\Entity\CataloguesArticles $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
