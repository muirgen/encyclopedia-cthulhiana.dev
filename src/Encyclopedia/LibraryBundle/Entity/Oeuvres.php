<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvres
 *
 * @ORM\Table(name="oeuvres")
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\OeuvresRepository")
 * 
 */
class Oeuvres {
   
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
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var \Year
     * 
     * @ORM\Column(name="date", columnDefinition="YEAR")
     */
    protected $date;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="format", type="string")
     */
    protected $format;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="OeuvresAlias", mappedBy="oeuvres")
     */
    protected $alias;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="CataloguesOeuvres", mappedBy="oeuvres")
     */
    protected $cataloguesOeuvres;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Persons", inversedBy="oeuvres", cascade={"persist","remove"})
     * @ORM\JoinTable(name="oeuvres_persons",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     *   }
     * )
     */
    protected $persons;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Publishing", mappedBy="oeuvres")
     */
    protected $publishing;
    
    public function getOeuvreAndFormat() {
        return $this->getName() . ' ( ' . $this->getformat() . ' )';
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cataloguesOeuvres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publishing = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Oeuvres
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
     * Set date
     *
     * @param string $date
     * @return Oeuvres
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return Oeuvres
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Add alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\OeuvresAlias $alias
     * @return Oeuvres
     */
    public function addAlias(\Encyclopedia\LibraryBundle\Entity\OeuvresAlias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\OeuvresAlias $alias
     */
    public function removeAlias(\Encyclopedia\LibraryBundle\Entity\OeuvresAlias $alias)
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
     * @return Oeuvres
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
     * Add persons
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Persons $persons
     * @return Oeuvres
     */
    public function addPerson(\Encyclopedia\LibraryBundle\Entity\Persons $persons)
    {
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Persons $persons
     */
    public function removePerson(\Encyclopedia\LibraryBundle\Entity\Persons $persons)
    {
        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Add publishing
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Publishing $publishing
     * @return Oeuvres
     */
    public function addPublishing(\Encyclopedia\LibraryBundle\Entity\Publishing $publishing)
    {
        $this->publishing[] = $publishing;

        return $this;
    }

    /**
     * Remove publishing
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Publishing $publishing
     */
    public function removePublishing(\Encyclopedia\LibraryBundle\Entity\Publishing $publishing)
    {
        $this->publishing->removeElement($publishing);
    }

    /**
     * Get publishing
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPublishing()
    {
        return $this->publishing;
    }
}
