<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons
 *
 * @ORM\Table(name="persons", indexes={@ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class Persons
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
     * @ORM\ManyToMany(targetEntity="Oeuvres", mappedBy="idPerson")
     */
    private $idOeuvre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     * @return Persons
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
}
