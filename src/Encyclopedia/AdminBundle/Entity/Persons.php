<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons
 *
 * @ORM\Table(name="persons")
 * @ORM\Entity
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
     * @ORM\ManyToMany(targetEntity="Oeuvres", inversedBy="persons")
     * @ORM\JoinTable(name="oeuvres_persons",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   }
     * )
     */
    protected $oeuvres;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Add oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     * @return Persons
     */
    public function addOeuvre(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres[] = $oeuvres;

        return $this;
    }

    /**
     * Remove oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     */
    public function removeOeuvre(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
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
