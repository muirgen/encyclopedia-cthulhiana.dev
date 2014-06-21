<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvres
 *
 * @ORM\Table(name="oeuvres", indexes={@ORM\Index(name="name", columns={"name", "date"})})
 * @ORM\Entity
 */
class Oeuvres
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=250, nullable=true)
     */
    private $format;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Catalogues", inversedBy="idOeuvre")
     * @ORM\JoinTable(name="catalogues_oeuvres",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     *   }
     * )
     */
    private $idCatalogue;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Persons", inversedBy="idOeuvre")
     * @ORM\JoinTable(name="oeuvres_persons",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     *   }
     * )
     */
    private $idPerson;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Publishing", inversedBy="idOeuvre")
     * @ORM\JoinTable(name="oeuvres_publishing",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_publishing", referencedColumnName="id")
     *   }
     * )
     */
    private $idPublishing;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCatalogue = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPerson = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPublishing = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \DateTime $date
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
     * @return \DateTime 
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
     * Add idCatalogue
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue
     * @return Oeuvres
     */
    public function addIdCatalogue(\Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue)
    {
        $this->idCatalogue[] = $idCatalogue;

        return $this;
    }

    /**
     * Remove idCatalogue
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue
     */
    public function removeIdCatalogue(\Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue)
    {
        $this->idCatalogue->removeElement($idCatalogue);
    }

    /**
     * Get idCatalogue
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdCatalogue()
    {
        return $this->idCatalogue;
    }

    /**
     * Add idPerson
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Persons $idPerson
     * @return Oeuvres
     */
    public function addIdPerson(\Encyclopedia\RessourcesBundle\Entity\Persons $idPerson)
    {
        $this->idPerson[] = $idPerson;

        return $this;
    }

    /**
     * Remove idPerson
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Persons $idPerson
     */
    public function removeIdPerson(\Encyclopedia\RessourcesBundle\Entity\Persons $idPerson)
    {
        $this->idPerson->removeElement($idPerson);
    }

    /**
     * Get idPerson
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Add idPublishing
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Publishing $idPublishing
     * @return Oeuvres
     */
    public function addIdPublishing(\Encyclopedia\RessourcesBundle\Entity\Publishing $idPublishing)
    {
        $this->idPublishing[] = $idPublishing;

        return $this;
    }

    /**
     * Remove idPublishing
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Publishing $idPublishing
     */
    public function removeIdPublishing(\Encyclopedia\RessourcesBundle\Entity\Publishing $idPublishing)
    {
        $this->idPublishing->removeElement($idPublishing);
    }

    /**
     * Get idPublishing
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPublishing()
    {
        return $this->idPublishing;
    }
}
