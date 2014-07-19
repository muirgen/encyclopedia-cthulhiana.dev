<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons
 *
 * @ORM\Table(name="persons")
 * @ORM\Entity(repositoryClass="Encyclopedia\LibraryBundle\Repository\PersonsRepository")
 * 
 */
class Persons {
    
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
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="PersonsAlias", mappedBy="id_person")
     */
    protected $alias;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Oeuvres", mappedBy="persons")
     */
    protected $oeuvres;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oeuvres = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Persons
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
     * Add alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\PersonsAlias $alias
     * @return Persons
     */
    public function addAlias(\Encyclopedia\LibraryBundle\Entity\PersonsAlias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \Encyclopedia\LibraryBundle\Entity\PersonsAlias $alias
     */
    public function removeAlias(\Encyclopedia\LibraryBundle\Entity\PersonsAlias $alias)
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
     * Add oeuvres
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres
     * @return Persons
     */
    public function addOeuvre(\Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres[] = $oeuvres;

        return $this;
    }

    /**
     * Remove oeuvres
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres
     */
    public function removeOeuvre(\Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres->removeElement($oeuvres);
    }

    /**
     * Get oeuvres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }
}
